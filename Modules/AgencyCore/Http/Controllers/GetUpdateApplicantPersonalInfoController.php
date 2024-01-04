<?php

namespace Modules\AgencyCore\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AgencyCore\Entities\Applicant;
use Modules\AgencyCore\Transformers\UpdateApplicantPersonalInfoResource;

class GetUpdateApplicantPersonalInfoController extends Controller
{
    public function __invoke(Applicant $applicant)
    {
        return new UpdateApplicantPersonalInfoResource($applicant->load('duties'));
    }
}
