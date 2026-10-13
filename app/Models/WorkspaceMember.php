<?php

namespace App\Models;

use App\Enums\WorkspaceRole;
use Illuminate\Database\Eloquent\Relations\Pivot;

class WorkspaceMember extends Pivot
{
    protected function casts(): array
    {
        return [
            'role' => WorkspaceRole::class,
        ];
    }
}