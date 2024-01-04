<?php

namespace Modules\AgencyCore\Enums;

enum ApplicantStatus: string
{
    case Active = 'active';
    case Pending = 'pending';
    case Inactive = 'inactive';

}
