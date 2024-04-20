<?php

namespace App\Enums;

enum ReportedType: string
{
    case CRIME = 'crime';
    case ORDINARY = 'oridinary';
    case WEATHER = 'weather';
}
