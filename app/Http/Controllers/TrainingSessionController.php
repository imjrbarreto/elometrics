<?php

namespace App\Http\Controllers;

use App\Enums\SessionStatus;
use App\Enums\TrainingSessionCategory;
use App\Http\Requests\TrainingSessionRequest;
use App\Http\Requests\StoreTrainingSessionRequest;
use App\Models\TrainingSession;
use App\Models\Workspace;
use Illuminate\Support\Facades\Gate;

class TrainingSessionController extends Controller
{
    public function create(Workspace $workspace)
    {
        Gate::authorize('manageTrainingSessions', $workspace);

        return view('training-sessions.create', [
            'workspace' => $workspace,
            'categories' => TrainingSessionCategory::cases(),
        ]);
    }

    public function store(TrainingSessionRequest $request, Workspace $workspace)
    {
        Gate::authorize('manageTrainingSessions', $workspace);

        $workspace->trainingSessions()->create($request->validated());

        return redirect()->route('workspaces.show', $workspace);
    }

    public function show(Workspace $workspace, TrainingSession $trainingSession)
    {
        Gate::authorize('show', $workspace);

        abort_unless($trainingSession->workspace_id === $workspace->id, 404);

        return view('training-sessions.show', compact('workspace', 'trainingSession'));
    }

    public function edit(Workspace $workspace, TrainingSession $trainingSession)
    {
        Gate::authorize('manageTrainingSessions', $workspace);
        abort_unless($trainingSession->workspace_id === $workspace->id, 404);

        return view('training-sessions.edit', [
            'workspace' => $workspace,
            'trainingSession' => $trainingSession,
            'statuses' => SessionStatus::cases(),   
            'categories' => TrainingSessionCategory::cases(),
        ]);
    }

    public function update(StoreTrainingSessionRequest $request, Workspace $workspace, TrainingSession $trainingSession)
    {
        Gate::authorize('manageTrainingSessions', $workspace);

        $trainingSession->update($request->validated());

        return redirect()->route('training-sessions.show', [$workspace, $trainingSession]);
    }

    public function destroy(Workspace $workspace, TrainingSession $trainingSession)
    {
        Gate::authorize('manageTrainingSessions', $workspace);

        abort_unless($trainingSession->workspace_id === $workspace->id, 404);

        $trainingSession->delete();

        return redirect()->route('workspaces.show', $workspace);
    }
}
