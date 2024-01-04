<?php

namespace Modules\AgencyCore\Services;

class ApplicantFamilyAttribute extends SetSchemalessAttribute
{
    protected $groupName = 'family';
    protected $atrributes = [
        'age_of_boy',
        'age_of_girl',
        'father_age',
        'father_name',
        'father_occupation',
        'mother_age',
        'mother_name',
        'mother_occupation',
        'number_in_family',
        'number_of_boy',
        'number_of_brother',
        'number_of_children',
        'number_of_girl',
        'number_of_sister',
        'position_in_family',
        'spouse_age',
        'spouse_name',
        'spouse_occupation',
    ];

}
