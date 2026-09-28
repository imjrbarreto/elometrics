<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Models\Workspace;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Workspace $workspace)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Workspace $workspace)
    {
        Gate::authorize('manageStudents', $workspace);

        return view('students.create', compact('workspace'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request, Workspace $workspace)
    {
        Gate::authorize('manageStudents', $workspace);

        $workspace->students()->create($request->validated());

        return redirect()->route('workspaces.show', $workspace);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
