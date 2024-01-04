<?php

namespace Modules\AgencyCore\Services;

class QuestionsAttribute extends SetSchemalessAttribute
{
    protected $groupName = 'questions';
    protected $atrributes = [
        'change_name',
        'change_name_info',
        'has_been_deport',
        'has_been_deport_info',
        'reject_visa',
        'reject_visa_info',
    ];

}
