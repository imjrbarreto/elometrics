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
            self::ACTIVE => 'bg-green-500',
            self::PAUSED => 'bg-amber-500',
            self::ARCHIVED => 'bg-gray-500',
        };
    }
    public function labelColor(): string 
    {
        return match($this) 
        {
            self::ACTIVE => 'text-green-500',
            self::PAUSED => 'text-amber-500',
            self::ARCHIVED => 'text-gray-500',
        };
    }
}

