<?php

namespace Modules\AgencyCore\Http\Controllers;

use App\Filters\SearchFilter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AgencyCore\Entities\Sellable;
use Modules\AgencyCore\Http\Requests\SellableUpdateRequest;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class SellableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse {
        $columnFilters = [
            'name',
            'editable',
            'is_active',
            'has_variants',
        ];

        $searchColumns = [
            'name',
        ];
        $query = QueryBuilder::for(Sellable::class)
                             ->with('variants')
                             ->allowedIncludes(['variants'])
                             ->allowedSorts([
                                                ...$columnFilters,
                                            ])
                             ->allowedFilters([
                                                  AllowedFilter::custom('search',
                                                                        new SearchFilter($searchColumns)),
                                                  AllowedFilter::scope('has_variants'),
                                                  AllowedFilter::exact('editable'),
                                                  AllowedFilter::exact('is_active'),
                                              ]);

        return response()->json($query->select([
                                                   'id',
                                                   'name',
                                                   'editable',
                                                   'is_active',
                                               ])->paginate($request->query('pageSize',
                                                                            15)));

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function store(Request $request) {
        //
    }

    /**
     * Show the specified resource.
     * @param \Modules\AgencyCore\Entities\Sellable $sellable
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Sellable $sellable) {
        $sellable->load('variants');

        return response()->json($sellable);
    }


    public function update(SellableUpdateRequest $request, Sellable $sellable): JsonResponse {
        $sellable->update($request->validated());

        return response()->json($sellable->refresh()->load('variants'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     */
    public function destroy($id) {
        //
    }

    public function all(): JsonResponse {
        return response()->json(Sellable::with('variants')->get());
    }

    public function create(): JsonResponse {
        return response()->json([]);
    }
}
