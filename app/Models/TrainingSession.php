<?php

namespace App\Models;

use App\Enums\SessionStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['title', 'date', 'summary', 'status'])]
class TrainingSession extends Model
{
    protected function casts(): array
    {
        return [
            'date' => 'date',
            'status' => SessionStatus::class,
        ];
    }

    public function workspace(): BelongsTo
    {
        return $this->belongsTo('workspace_id');
    }
}
