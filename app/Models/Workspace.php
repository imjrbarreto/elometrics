<?php

namespace App\Models;

use App\Enums\WorkspaceStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['title', 'status'])]
class Workspace extends Model
{

    protected function casts(): array
    {
        return [
            'status' => WorkspaceStatus::class,
        ];
    }

    #[Scope]
    protected function withStudentsSummary(Builder $query): void
    {
        $query->withCount('students')->latest();
    }

    #[Scope]
    protected function filterByStatus(Builder $query, ?WorkspaceStatus $status = null): void
    {
        if($status)
            {
                $query->where('status', $status);
            }
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function trainingSessions(): HasMany
    {
        return $this->hasMany(TrainingSession::class);
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'workspace_members')->withPivot('role')->withTimestamps();
    }
}
