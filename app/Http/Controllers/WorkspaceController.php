<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkspaceRequest;
use App\Http\Requests\UpdateWorkspaceRequest;
use App\Models\TrainingSession;
use App\Models\Workspace;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class WorkspaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $workspaces = $request->user()->workspaces()->withCount('students')->latest()->get();

        return view('workspaces.index', compact('workspaces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Workspace::class);

        return view('workspaces.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWorkspaceRequest $request)
    {
        Gate::authorize('create', Workspace::class);

        $workspace = $request->user()->workspaces()->create($request->validated());

        return redirect()->route('workspaces.show', $workspace);
    }

    /**
     * Display the specified resource.
     */
    public function show(Workspace $workspace)
    {
        Gate::authorize('show', $workspace);

        $students = $workspace->students()->orderBy('name')->get();

        $trainingSessions = $workspace->trainingSessions()->orderByDesc('date')->get();

        return view('workspaces.show', compact('workspace', 'students', 'trainingSessions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Workspace $workspace)
    {
        Gate::authorize('update', $workspace);

        return view('workspaces.edit', compact('workspace'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkspaceRequest $request, Workspace $workspace)
    {
        Gate::authorize('update', $workspace);

        $workspace->update($request->validated());

        return redirect()->route('workspaces.show', $workspace);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workspace $workspace)
    {
        Gate::authorize('delete', $workspace);

        $workspace->delete();

        return redirect()->route('workspaces.index');
    }
}
