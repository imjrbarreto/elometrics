<?php

namespace App\Livewire;

use App\Models\Workspace;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class WorkspaceList extends Component
{
    use WithPagination;

    public function render(Request $request)
    {
        Gate::authorize('viewAny', Workspace::class);

        $user = $request->user();

        abort_unless($user, 403);

        $workspaces = Workspace::query()
            ->accessibleTo($user)
            ->withStudentsSummary()
            ->paginate(6);

        return view('livewire.workspace-list', compact('workspaces'));
    }
}