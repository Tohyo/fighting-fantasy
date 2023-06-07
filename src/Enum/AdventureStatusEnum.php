<?php

namespace App\Enum;

enum AdventureStatusEnum: int
{
    case ACTIVE = 1;
    case COMPLETED = 2;
    case FAILED = 3;
    case ABANDONED = 4;
}
