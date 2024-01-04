<?php

namespace Modules\AgencyCore\Services;

class ApplicantEducationAttribute extends SetSchemalessAttribute
{
    protected $groupName = 'education';
    protected $atrributes = [
        'graduation_year',
        'highest_education',
        'major',
        'school_name',
    ];

}
