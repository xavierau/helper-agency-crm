<?php

namespace Modules\AgencyCore\Http\Controllers;

use App\Filters\SearchFilter;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AgencyCore\Entities\DomesticDuty;
use Modules\AgencyCore\Http\Requests\DomesticDutyStoreRequest;
use Modules\AgencyCore\Http\Requests\DomesticDutyUpdateRequest;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class DomesticDutyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {
        $columnFilters = [
            'label',
        ];
        $searchColumns = [
            'label',
        ];
        $query = QueryBuilder::for(DomesticDuty::class)
                             ->allowedSorts([
                                                ...$columnFilters,
                                            ])
                             ->allowedFilters([
                                                  AllowedFilter::custom('search',
                                                                        new SearchFilter($searchColumns)),
                                                  ...$searchColumns,
                                              ]);

        return response()->json($query->paginate($request->query('pageSize',
                                                                 15)));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function store(DomesticDutyStoreRequest $request) {

        $duty = DomesticDuty::create($request->validated());

        return response()->json($duty);

    }

    /**
     * Show the specified resource.
     * @param int $id
     */
    public function show($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int     $id
     */
    public function update(DomesticDutyUpdateRequest $request, DomesticDuty $duty) {
        $duty->update($request->validated());

        return response()->json($duty);
    }


    public function destroy(DomesticDuty $duty) {
        $duty->delete();

        return response()->json(['status' => 'completed']);
    }

    public function all() {
        return response()->json(DomesticDuty::get(['label', 'id']));
    }
}
