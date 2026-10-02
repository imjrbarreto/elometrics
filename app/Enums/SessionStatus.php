<?php

namespace App\Enums;

enum SessionStatus: String
{
    case SCHEDULED = 'scheduled';
    case COMPLETED = 'completed';
    case CANCELED = 'canceled';

    public function label(): string
    {
        return match($this)
        {
            self::SCHEDULED => 'Programado',
            self::COMPLETED => 'Completado',
            self::CANCELED => 'Cancelado',
        };
    }

    public function color(): string 
    {
        return match($this) 
        {
            self::SCHEDULED => 'bg-blue-500',
            self::COMPLETED => 'bg-green-500',
            self::CANCELED => 'bg-red-500',
        };
    }
    public function labelColor(): string 
    {
        return match($this) 
        {
            self::SCHEDULED => 'text-blue-500',
            self::COMPLETED => 'text-green-500',
            self::CANCELED => 'text-red-500',
        };
    }
}
