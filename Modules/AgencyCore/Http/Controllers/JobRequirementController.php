<?php

namespace Modules\AgencyCore\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\AgencyCore\Actions\UpdateJobRequirement;
use Modules\AgencyCore\DataTransferObject\RequirementData;
use Modules\AgencyCore\Entities\Job;
use Modules\AgencyCore\Entities\Requirement;
use Modules\AgencyCore\Transformers\RequirementResource;

class JobRequirementController extends Controller
{
    /**
     * @param \Illuminate\Http\Request                         $request
     * @param \Modules\AgencyCore\Entities\Job                 $job
     * @param \Modules\AgencyCore\Actions\UpdateJobRequirement $action
     * @return \Modules\AgencyCore\Transformers\RequirementResource
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(
        Request $request, Job $job, UpdateJobRequirement $action): RequirementResource {
        $validatedData = $this->validate($request,
                                         Requirement::GetValidationRules());


        $requirement = $action->execute($job,
                                        RequirementData::fromFormData($validatedData));

        return new RequirementResource($requirement);
    }
}
