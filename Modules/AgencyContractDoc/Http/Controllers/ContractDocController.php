<?php

namespace Modules\AgencyContractDoc\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\AgencyContractDate\Http\Requests\ContractDateOrderingRequest;
use Modules\AgencyContractDoc\Actions\AssignContractDoc;
use Modules\AgencyContractDoc\DataTransferObject\AssignContractDocData;
use Modules\AgencyContractDoc\Entities\ContractDoc;
use Modules\AgencyContractDoc\Entities\ContractDocSet;
use Modules\AgencyContractDoc\Http\Requests\ContractDocAssignRequest;

class ContractDocController extends Controller
{
    public function all(): JsonResponse {
        return response()->json(ContractDoc::select('label',
                                                    'id'
        )->get());
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request): JsonResponse {
        $query = ContractDoc::query()
                            ->when($request->query("filter['label']"),
                                fn($q, $keyword) => $q->where('label',
                                                              'like',
                                                              "%{$keyword}%"));


        return response()->json($query->paginate($request->query('pageSize',
                                                                 15)));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse {
        $validatedData = $this->validate($request,
                                         [
                                             'label' => 'required',
                                         ]);

        return response()->json(ContractDoc::create($validatedData));
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
        ContractDocAssignRequest $request, AssignContractDoc $action): JsonResponse {

        $contractDate = $action->execute(AssignContractDocData::fromFormData($request->validated()));

        return response()->json($contractDate);
    }

    public function ordering(
        ContractDateOrderingRequest $request): JsonResponse {

        $first = ContractDocSet::where('contract_type_id',
                                       $request->get('contract_type_id'))
                               ->where('contract_doc_id',
                                       $request->get('contract_doc_1_id'))
                               ->firstOrFail();

        $second = ContractDocSet::where('contract_type_id',
                                        $request->get('contract_type_id'))
                                ->where('contract_doc_id',
                                        $request->get('contract_doc_2_id'))
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
