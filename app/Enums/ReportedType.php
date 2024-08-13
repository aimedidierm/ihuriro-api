<?php

namespace App\Enums;

enum ReportedType: string
{
    case CRIME = 'Crime';
    case PROPERTYDAMAGE = 'Property damage';
    case ACCIDENTREPORT = 'Accident report';
    case FIREINCIDENT = 'Fire incident';
    case WEATHERINCIDENT = 'Weather incident';
    case OTHERS = 'Others';
}
