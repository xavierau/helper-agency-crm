<?php

namespace Modules\AgencyFinance\Http\Controllers;

use App\Filters\SearchFilter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\AgencyCore\Filters\PaymentClientNameFilter;
use Modules\AgencyFinance\Actions\CreatePayment;
use Modules\AgencyFinance\DataTransferObject\CreatePaymentDTO;
use Modules\AgencyFinance\Entities\Payment;
use Modules\AgencyFinance\Http\Requests\PaymentStoreRequest;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request) {
        $columnFilters = [
            'invoice.invoice_number',
            'client.mobile',
            'invoice_id',
        ];

        $searchColumns = [
            'invoice.invoice_number',
            'invoice_id',
        ];
        $query = QueryBuilder::for(Payment::class)
                             ->with(['invoice.client'])
                             ->latest()
                             ->allowedFields(['invoice.client.mobile', 'invoice.invoice_number'])
                             ->allowedIncludes(['invoice.client'])
                             ->allowedSorts([
                                                ...$columnFilters,
                                            ])
                             ->allowedFilters([
                                                  AllowedFilter::custom('search',
                                                                        new SearchFilter($searchColumns)),
                                                  AllowedFilter::custom('invoice.client.name',
                                                                        new PaymentClientNameFilter),
                                                  ...$columnFilters,
                                              ])
                             ->when($request->get('client_id'),
                                 function($q, $clientId) {
                                     return $q->whereHas('invoice.client',
                                         function($sq)use($clientId) {
                                             return $sq->where('id',
                                                               $clientId);

                                         });
                                 });


        return response()->json($query->paginate($request->query('pageSize',
                                                                 15)));
    }

    /**
     * Store a newly created resource in storage.
     * @param \Modules\AgencyFinance\Http\Requests\PaymentStoreRequest $request
     * @param \Modules\AgencyFinance\Actions\CreatePayment             $action
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PaymentStoreRequest $request, CreatePayment $action): JsonResponse {

        DB::beginTransaction();

        try {
            $newPayment = $action->execute(new CreatePaymentDTO($request));

            if($file = $request->file('attachment')) {
                $newPayment->addMedia($file)->toMediaCollection('attachments');
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }


        return response()->json($newPayment);

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
