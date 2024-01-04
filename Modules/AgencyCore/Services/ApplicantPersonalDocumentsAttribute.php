<?php

namespace Modules\AgencyCore\Services;

class ApplicantPersonalDocumentsAttribute extends SetSchemalessAttribute
{
    protected $groupName = 'personal_document';
    protected $atrributes = [
        'hk_id',
        'hk_id_expiry_date',
        'passport',
        'passport_expiry_date',
        'passport_issued_date',
        'passport_place_of_issue',
        'visa_expiry_date'
    ];

}
