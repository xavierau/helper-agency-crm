<?php

namespace Modules\AgencyContract\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\AgencyContract\Actions\UpdateContractRequirement;
use Modules\AgencyContract\Entities\Contract;
use Modules\AgencyCore\DataTransferObject\RequirementData;
use Modules\AgencyCore\Entities\Requirement;
use Modules\AgencyCore\Transformers\RequirementResource;

class ContractRequirementController extends Controller
{


    /**
     * Update the specified resource in storage.
     * @param Request                                                   $request
     * @param \Modules\AgencyContract\Entities\Contract                 $contract
     * @param \Modules\AgencyContract\Actions\UpdateContractRequirement $action
     * @return \Modules\AgencyCore\Transformers\RequirementResource
     */
    public function update(
        Request $request, Contract $contract, UpdateContractRequirement $action) {

        $validatedData = $this->validate($request,
                                         Requirement::GetValidationRules());


        $requirement = $action->execute($contract,
                                        RequirementData::fromFormData($validatedData));

        return new RequirementResource($requirement);

    }

}
