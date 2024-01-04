<?php

namespace Modules\AgencyFinance\Http\Controllers;

use App\Services\FilterEntity;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\AgencyFinance\Entities\CreditNote;
use Modules\AgencyFinance\Transformers\CreditNoteCollection;

class CreditNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request $request
     * @return \Modules\AgencyFinance\Transformers\CreditNoteCollection
     */
    public function index(Request $request): CreditNoteCollection {
        $query = FilterEntity::model(CreditNote::class)
                             ->addScopeFilter('contractTypeLabel')
                             ->addScopeFilter('search')
                             ->getQuery();
        $query = $query->with(['fromContract.client', 'toContract.client'])
                       ->when($request->get('client_id'),
                           function($q, string $clientId) {
                               $q->whereHas('fromContract.client',
                                   function($sq) use ($clientId) {
                                       return $sq->where('id',
                                                         $clientId);
                                   });
                           });

        $sort = $request->get('sort',
                              'created_at');
        $order = 'desc';

        if(Str::startsWith($sort,
                           '-')) {
            $order = 'desc';
            $sort = substr($sort,
                           1);
        }

        $query = $query->orderBy($sort,
                                 $order);

        $creditNotes = $query->paginate($request->query('pageSize',
                                                        15));

        return new CreditNoteCollection($creditNotes);
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
