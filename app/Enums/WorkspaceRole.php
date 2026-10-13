<?php

namespace App\Enums;

enum WorkspaceRole: string
{
    case COACH = 'coach';
    case STUDENT = 'student';
    case VIEWER = 'viewer';

    public function label(): string
    {
        return match ($this) {
            self::COACH => 'entrenador',
            self::STUDENT => 'alumno',
            self::VIEWER => 'observador',
        };
    }
}
