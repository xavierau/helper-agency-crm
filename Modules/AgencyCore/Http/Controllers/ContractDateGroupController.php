<?php

namespace Modules\AgencyCore\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\AgencyCore\Actions\ContractDate\CreateContractDate;
use Modules\AgencyCore\Actions\ContractDate\DeleteContractDate;
use Modules\AgencyCore\Actions\ContractDate\UpdateContractDate;
use Modules\AgencyCore\DataTransferObject\ContractDate\ContractDateData;
use Modules\AgencyCore\Entities\ContractDate;
use Modules\AgencyCore\Transformers\ContractDateResource;


class ContractDateGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(): JsonResponse {
        return response()->json(ContractDateResource::collection(ContractDate::all()));
    }


    /**
     * @param \Illuminate\Http\Request                                    $request
     * @param \Modules\AgencyCore\Actions\ContractDate\CreateContractDate $action
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, CreateContractDate $action): JsonResponse {
        $validatedData = $this->validate($request,
                                         [
                                             'label' => 'required',
                                         ]);

        $contract_date = $action->execute(ContractDateData::fromFormData($validatedData));

        return response()->json(new ContractDateResource($contract_date));

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id) {
        //
    }


    /**
     * @param \Illuminate\Http\Request                                    $request
     * @param \Modules\AgencyCore\Entities\ContractDate                   $contractDate
     * @param \Modules\AgencyCore\Actions\ContractDate\UpdateContractDate $action
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(
        Request $request, ContractDate $contractDate, UpdateContractDate $action): JsonResponse {
        $validatedData = $this->validate($request,
                                         [
                                             'label' => 'required',
                                         ]);

        $contract_date = $action->execute($contractDate,
                                          ContractDateData::fromFormData($validatedData));

        return response()->json(new ContractDateResource($contract_date));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(ContractDate $contractDate, DeleteContractDate $aciton): JsonResponse {
        $aciton->execute($contractDate);

        return response()->json('completed');
    }
}
