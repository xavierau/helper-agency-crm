<?php

namespace Modules\AgencyCore\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AgencyCore\Actions\UpdateApplicantPersonalInfoAction;
use Modules\AgencyCore\DataTransferObject\UpdatePersonalInfoDTO;
use Modules\AgencyCore\Entities\Applicant;
use Modules\AgencyCore\Http\Requests\UpdatePersonalInfoRequest;
use Modules\AgencyCore\Transformers\ApplicantShowResource;

class PutUpdateApplicantPersonalInfoController extends Controller
{
    public function __invoke(
        Applicant                         $applicant,
        UpdatePersonalInfoRequest         $request,
        UpdateApplicantPersonalInfoAction $action
    )
    {

        $applicant = $action->execute($applicant, UpdatePersonalInfoDTO::fromRequest($request));

        return new ApplicantShowResource($applicant);
    }
}
