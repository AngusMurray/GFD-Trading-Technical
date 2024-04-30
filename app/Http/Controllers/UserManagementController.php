<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Gate;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', auth()->user());

        return Inertia::render('UserManagement/List', [
            'users' => User::all()->load(['department']),
        ]);
    }
}
