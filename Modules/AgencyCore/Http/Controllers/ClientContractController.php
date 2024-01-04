<?php

namespace Modules\AgencyCore\Http\Controllers;

use App\Filters\SearchFilter;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\AgencyCore\Entities\Client;
use Modules\AgencyCore\Entities\Contract;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ClientContractController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Client $client, Request $request) {
        $columnFilters = [
            'contract_number',
            'applicant.name',
            'start_date',
            'end_date',
        ];

        $searchColumns = [
            'contract_number',
            'applicant.name',
            'applicant.mobile',
        ];
        $query = QueryBuilder::for(Contract::class)
                             ->whereClientId($client->id)
                             ->allowedSorts($columnFilters)
                             ->allowedFilters([
                                                  AllowedFilter::custom('search',
                                                                        new SearchFilter($searchColumns)),
                                                  ...$searchColumns,
                                              ])
                             ->with('applicant');

        return response()->json($query->paginate($request->query('pageSize',
                                                                 15)));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {
        //
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
}
