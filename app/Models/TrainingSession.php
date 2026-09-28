<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['title'])]
class TrainingSession extends Model
{
    protected function casts(): array
    {
        return ['date' => 'date'];
    }

    public function workspace(): BelongsTo
    {
        return $this->belongsTo('workspace_id');
    }
}
