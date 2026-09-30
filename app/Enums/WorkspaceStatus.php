<?php

namespace App\Enums;

enum WorkspaceStatus: string
{
    case ACTIVE = 'active';
    case PAUSED = 'paused';
    case ARCHIVED = 'archived';
    
    public function label(): string
    {
        return match($this)
        {
            self::ACTIVE => 'Activo',
            self::PAUSED => 'Pausado',
            self::ARCHIVED => 'Archivado',
        };
    }

    public function color(): string 
    {
        return match($this) 
        {
            self::ACTIVE => 'text-green-500',
            self::PAUSED => 'text-yellow-500',
            self::ARCHIVED => 'text-red-500',
        };
    }
}

