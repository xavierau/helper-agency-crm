<?php

namespace Modules\AgencyContract\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\AgencyContract\Actions\UpdateContractDate;
use Modules\AgencyContract\DataTransferObjects\ContractDateData;
use Modules\AgencyContract\Entities\Contract;
use Modules\AgencyContract\Http\Requests\ContractAddDateRequest;
use Modules\AgencyContract\Http\Requests\UpdateContractDateRequest;

class ContractDateController extends Controller
{
    public function addDate(
        Contract $contract, ContractAddDateRequest $request,
        UpdateContractDate $action): JsonResponse {
        $action->execute($contract,
                         ContractDateData::fromFormData($request->validated()));

        return response()->json('completed');
    }

    public function updateDate(
        Contract $contract, UpdateContractDateRequest $request,
        UpdateContractDate $action): JsonResponse {

        $action->execute($contract,
                         ContractDateData::fromFormData($request->validated()));

        return response()->json('completed');
    }
}
