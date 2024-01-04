<?php

namespace Modules\AgencyContractDate\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\AgencyContractDate\Actions\AssignContractDate;
use Modules\AgencyContractDate\Actions\CreateContractDate;
use Modules\AgencyContractDate\DataTransferObject\AssignContractDateData;
use Modules\AgencyContractDate\DataTransferObject\ContractDateData;
use Modules\AgencyContractDate\Entities\ContractDate;
use Modules\AgencyContractDate\Entities\ContractDateSet;
use Modules\AgencyContractDate\Http\Requests\ContractDateAssignRequest;
use Modules\AgencyContractDate\Http\Requests\ContractDateOrderingRequest;
use Modules\AgencyContractDate\Http\Requests\ContractDateStoreRequest;

class ContractDateController extends Controller
{

    public function all(): JsonResponse {
        return response()->json(ContractDate::select('label',
                                                     'id'
        )->get());
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse {
        $query = ContractDate::query()
                             ->when($request->query("filter['label']"),
                                 fn($q, $keyword) => $q->where('label',
                                                               'like',
                                                               "%{$keyword}%"));


        return response()->json($query->paginate($request->query('pageSize',
                                                                 15)));
    }


    /**
     * @param \Modules\AgencyContractDate\Http\Requests\ContractDateStoreRequest $request
     * @param \Modules\AgencyCore\Actions\ContractDate\CreateContractDate        $action
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(
        ContractDateStoreRequest $request, CreateContractDate $action): JsonResponse {

        $date = $action->execute(ContractDateData::fromFormData($request->validated()));

        return response()->json($date);

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

    public function assign(
        ContractDateAssignRequest $request, AssignContractDate $action): JsonResponse {

        $contractDate = $action->execute(AssignContractDateData::fromFormData($request->validated()));

        return response()->json($contractDate);
    }

    public function ordering(
        ContractDateOrderingRequest $request): JsonResponse {

        $first = ContractDateSet::where('contract_type_id',
                                        $request->get('contract_type_id'))
                                ->where('contract_date_id',
                                        $request->get('contract_date_1_id'))
                                ->firstOrFail();
        $second = ContractDateSet::where('contract_type_id',
                                         $request->get('contract_type_id'))
                                 ->where('contract_date_id',
                                         $request->get('contract_date_2_id'))
                                 ->firstOrFail();


        $temp = $first->order;
        $first->update([
                           'order' => $second->order,
                       ]);
        $second->update([
                            'order' => $temp,
                        ]);

        return response()->json('completed');
    }
}
