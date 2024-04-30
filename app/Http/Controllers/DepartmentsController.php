<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class DepartmentsController extends Controller
{
    public function __invoke() : InertiaResponse
    {
        $user = auth()->user();
        $user->load([
            'department'
        ]);

        if ($user->department->name === 'Sales') {
            return $this->salesDashboard($user->department, $user);
        } elseif ($user->department->name === 'Order processing') {
            return $this->orderProcessingDashboard($user->department, $user);
        }

        return $this->supportDashboard($user->department, $user);
    }
    /**
     * Display the specified resource.
     */
    public function salesDashboard(Department $department, User $user)
    {
        Gate::authorize('view', $department, $user);

        return Inertia::render('Department/Sales', [
            'department' => Department::all(['id', 'name'])
        ]);
    }

        /**
     * Display the specified resource.
     */
    public function orderProcessingDashboard(Department $department, User $user)
    {
        Gate::authorize('view', $department, $user);

        return Inertia::render('Department/OrderProcessing', [
            'department' => Department::all(['id', 'name'])
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function supportDashboard(Department $department, User $user)
    {
        Gate::authorize('view', $department, $user);

        return Inertia::render('Department/Support', [
            'department' => Department::all(['id', 'name'])
        ]);
    }
}
