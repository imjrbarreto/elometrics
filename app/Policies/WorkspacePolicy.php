<?php

namespace App\Policies;

use App\Enums\WorkspaceRole;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Auth\Access\Response;

class WorkspacePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function show(User $user, Workspace $workspace): bool
    {
        return $workspace->user_id === $user->id || $workspace->members()->where('user_id', $user->id)->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Workspace $workspace): bool
    {
        return $workspace->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Workspace $workspace): bool
    {
        return $workspace->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Workspace $workspace): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Workspace $workspace): bool
    {
        return false;
    }

    private function isOwnerOrCoach(User $user, Workspace $workspace): bool
    {
        return $workspace->user_id === $user->id || $workspace->members()->where('users.id', $user->id)->wherePivot('role', WorkspaceRole::COACH->value)->exists();
    }

    public function manageStudents(User $user, Workspace $workspace): bool
    {
        return $this->isOwnerOrCoach($user, $workspace);
    }
    
    public function manageTrainingSessions(User $user, Workspace $workspace): bool
    {
        return $this->isOwnerOrCoach($user, $workspace);
    }
}
