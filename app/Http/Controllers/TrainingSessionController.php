<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrainingSessionRequest;
use App\Models\Workspace;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class TrainingSessionController extends Controller
{
    public function create(Workspace $workspace)
    {
        Gate::authorize('manageTrainingSessions', $workspace);

        return view('training-sessions.create', compact('workspace'));
    }

    public function store(TrainingSessionRequest $request, Workspace $workspace)
    {
        Gate::authorize('manageTrainingSessions', $workspace);

        $workspace->trainingSessions()->create($request->validated());

        return redirect()->route('workspaces.show', $workspace)->with('success', 'Sesion creada correctamente.');
    }
}
