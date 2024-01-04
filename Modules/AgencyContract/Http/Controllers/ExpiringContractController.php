<?php

namespace Modules\AgencyContract\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\AgencyContract\Entities\Contract;
use Modules\AgencyContract\Transformers\ContractListResource;

class ExpiringContractController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = Contract::whereNotNull('end_date')
            ->where('end_date',
                '<',
                $request->get('end_days_inadvanced',
                    now()->addDays(180)));

        $contracts = $query->paginate($request->query('pageSize',
            15));

        return new ContractListResource($contracts);
    }
}
