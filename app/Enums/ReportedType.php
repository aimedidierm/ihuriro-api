<?php

namespace App\Enums;

enum ReportedType: string
{
    case CRIME = 'Crime';
    case PROPERTYDAMAGE = 'PropertyDamage';
    case ACCIDENTREPORT = 'AccidentReport';
    case FIREINCIDENT = 'FireIncident';
    case WEATHERINCIDENT = 'WeatherIncident';
    case OTHERS = 'Others';
}
