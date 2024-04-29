<?php

namespace App\Http\Controllers;

use App\Models\departments;
use App\Http\Requests\StoredepartmentsRequest;
use App\Http\Requests\UpdatedepartmentsRequest;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoredepartmentsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(departments $departments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(departments $departments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatedepartmentsRequest $request, departments $departments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(departments $departments)
    {
        //
    }
}
