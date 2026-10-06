<?php

namespace App\Livewire;

use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithPagination;

class WorkspaceList extends Component
{
    use WithPagination;

    #[Locked]
    public string $tab = 'owned';

    public function selectTab(string $tab): void
    {
        abort_unless(in_array($tab, ['owned', 'shared'], true), 404);

        $this->tab = $tab;

        $this->resetPage();
    }

    public function render(Request $request)
    {
        Gate::authorize('viewAny', Workspace::class);

        $user = $request->user();

        abort_unless($user, 403);

        $query = match ($this->tab) {
            'owned' => $user->workspaces(),
            'shared' => $user->joinedWorkspaces(),
        };

        $workspaces = $query
            ->withStudentsSummary()
            ->orderByDesc('workspaces.created_at')
            ->orderByDesc('workspaces.id')
            ->paginate(6);

        return view('livewire.workspace-list', compact('workspaces'));
    }
}