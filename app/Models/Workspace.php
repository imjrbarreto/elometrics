<?php

namespace App\Models;

use App\Enums\WorkspaceStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

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
}
