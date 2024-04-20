<?php

namespace App\Enums;

enum UserRole: string
{
    case USER = 'user';
    case LAW = 'law';
    case GOVERNMENT = 'government';
}
