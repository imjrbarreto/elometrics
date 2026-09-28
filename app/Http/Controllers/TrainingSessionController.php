<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrainingSessionRequest;
use App\Models\TrainingSession;
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

    public function show(Workspace $workspace, TrainingSession $trainingSession)
    {
        Gate::authorize('manageTrainingSessions', $workspace);


        abort_unless($trainingSession->workspace_id === $workspace->id, 404);

        return view('training-sessions.show', compact('workspace', 'trainingSession'));
    }
}
