<?php

namespace Modules\AgencyCore\Http\Controllers;

use App\Filters\SearchFilter;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Validation\ValidationException;
use Modules\AgencyCore\Entities\Supplier;
use Modules\AgencyCore\Transformers\SupplierCollection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $columnFilters = [
            'name',
            'code',
        ];

        $searchColumns = [
            'name',
            'code',
        ];
        $query = $this->getQueryBuilder($columnFilters,
            $searchColumns);

        $result = $query->when($request->query('pageSize',
                null) === null,
            function ($query) {
                return $query->get();
            },
            function ($query) use ($request) {
                return $query->paginate($request->query('pageSize',
                    15));
            });


        return new SupplierCollection($result);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $this->validate($request, [
            'name' => ['required'],
            'code' => ['required', (new Unique('suppliers', 'code'))],
        ]);

        Supplier::create($validatedData);

        return response()->json(null, 204);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Supplier $supplier
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, Supplier $supplier): JsonResponse
    {
        $validatedData = $this->validate($request, [
            'name' => ['required'],
            'code' => ['required', (new Unique('suppliers', 'code'))->ignore($supplier->id)],
        ]);

        $supplier->update($validatedData);

        return response()->json(null, 204);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * @param array $columnFilters
     * @param array $searchColumns
     * @return \Spatie\QueryBuilder\QueryBuilder
     */
    private function getQueryBuilder(
        array $columnFilters, array $searchColumns): \Spatie\QueryBuilder\QueryBuilder
    {
        $query = QueryBuilder::for(Supplier::class)
            ->allowedSorts([
                ...$columnFilters,
            ])
            ->allowedFilters([
                ...$columnFilters,
                AllowedFilter::custom('search', new SearchFilter($searchColumns)),

            ]);

        return $query;
    }
}
