<?php

namespace Modules\AgencyCore\Services;

class HolidayArrangementAttribute extends SetSchemalessAttribute
{
    protected $groupName = 'holiday_arrangement';
    protected $atrributes = [
        "sunday",
        "weeekday",
        "alternative",
        "no_holidays",
        "once_a_month",
    ];

}
