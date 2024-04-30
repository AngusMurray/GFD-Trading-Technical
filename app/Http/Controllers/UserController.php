<?php

namespace App\Http\Controllers;

use App\Enums\UserStatusEnum;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UpdateUserStatusRequest;
use App\Http\Requests\UserDeleteRequest;
use App\Models\Department;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request, User $user): Response
    {
        Gate::authorize('view', auth()->user());
        
        return Inertia::render('Profile/Edit', [
            'is' => [
                'self' => $user->is(auth()->user()),
                'active' => $user->isActive()
            ],
            'user' => $user->load([
                'department'
            ]),
            'departments' => Department::all(['id', 'name']),
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();
        $user->update($validated);

        if(array_key_exists('department_id', $validated)) {
            $user->department()->associate($validated['department_id']);
        }

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit', ['user' => $user]);
    }

    
    /**
     * Set user status
     */
    public function status( UpdateUserStatusRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();

        if($validated['status'] == true) {
            $user->status = UserStatusEnum::ACTIVE->value;
        } else {
            $user->status = UserStatusEnum::INACTIVE->value;
        }
        $user->save();

        return Redirect::route('profile.edit', ['user' => $user]);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(UserDeleteRequest $request, User $user): RedirectResponse
    {
        $request->validated();

        Auth::logout();
        
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
