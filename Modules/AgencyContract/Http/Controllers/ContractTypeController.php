<?php

namespace Modules\AgencyContract\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\AgencyContract\Actions\CreateContractType;
use Modules\AgencyContract\DataTransferObjects\ContractTypeData;
use Modules\AgencyContract\Entities\ContractType;
use Modules\AgencyContract\Transformers\ContractTypeResource;

class ContractTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(): JsonResponse {

        $query = ContractType::query();
        $query->with(['contractDates', 'contractDocuments', 'templates']);


        return response()->json(ContractTypeResource::collection($query->get()));
    }

    public function store(Request $request, CreateContractType $action): JsonResponse {
        $validatedData = $this->validate($request,
                                         [
                                             'label' => 'required',
                                         ]);

        return response()->json(new ContractTypeResource($action->execute(ContractTypeData::fromFormData($validatedData))));
    }


    public function show(ContractType $contract_type): JsonResponse {
        $contract_type->load(['contractDates', 'contractDocuments', 'templates']);

        return response()->json(new ContractTypeResource($contract_type));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int     $id
     * @return Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id) {
        //
    }
}
