<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkspaceMemberRequest;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Gate;

class WorkspaceMemberController extends Controller
{
    public function store(StoreWorkspaceMemberRequest $request, Workspace $workspace): RedirectResponse
    {
        $data = $request->validated();

        $member = User::query()->where('users.username', $data['username'])->firstOrFail();

        if ($workspace->user_id === $member->id)
        {
            throw ValidationException::withMessages([
                'username' => 'Este usuario ya es el propietario.'
            ]);
        }

        if ($workspace->members()->where('users.id', $member->id)->exists())
        {
            throw ValidationException::withMessages([
                'username' => 'Este usuario ya pertenece al workspace.',
            ]);
        }

        $workspace->members()->attach($member->id, [
            'role' => $data['role'],
        ]);

        return redirect()->route('workspaces.show', $workspace);
    }

    public function destroy(Workspace $workspace, User $member): RedirectResponse
    {
        Gate::authorize('manageMembers', $workspace);

        abort_unless($workspace->members()->where('users.id', $member->id)->exists(), 404);

        $workspace->members()->detach($member->id);

        return redirect()->route('workspaces.show', $workspace);
    }

    public function leave(Request $request, Workspace $workspace): RedirectResponse
    {
        Gate::authorize('leave', $workspace);

        $workspace->members()->detach($request->user()->id);

        return redirect()->route('workspaces.index');
    }
}
