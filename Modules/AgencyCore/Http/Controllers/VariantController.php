<?php

namespace Modules\AgencyCore\Http\Controllers;

use App\Filters\SearchFilter;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\AgencyCore\Entities\Variant;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class VariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        $columnFilters = [
            'name',
        ];

        $searchColumns = [
            'name',
        ];
        $query = QueryBuilder::for(Variant::class)
                             ->allowedSorts($columnFilters)
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
    public function store(Request $request) {
        $validatedData = $this->validate($request,
                                         [
                                             'name' => 'required',
                                         ]);

        $variant = Variant::create($validatedData);

        return response()->json($variant);
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
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     */
    public function destroy($id) {
        //
    }

    public function all(): JsonResponse {
        return response()->json(Variant::all());
    }
}
