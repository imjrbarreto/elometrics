<?php

namespace App\Enums;

enum WorkspaceRole: string
{
    case COACH = 'coach';
    case STUDENT = 'student';
    case VIEWER = 'viewer';
}
