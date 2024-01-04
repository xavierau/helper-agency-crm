<?php

namespace Modules\AgencyCore\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AgencyContract\Entities\Contract;
use Modules\AgencyCore\DataTransferObject\GlobalSearchResult;
use Modules\AgencyCore\Entities\Applicant;
use Modules\AgencyCore\Entities\Client;

class SearchController extends Controller
{

    /**
     * SearchController constructor.
     * @param \Illuminate\Http\Request $request
     */
    public function __invoke(Request $request)
    {

        if ($request->get('keyword') === null) {
            return response()->json([]);
        }

        $applicants = Applicant::globalSearch($request->get('keyword'));

        $clients = Client::globalSearch($request->get('keyword'));

        $contracts = Contract::globalSearch($request->get('keyword'));

        $all = collect([]);
        $all = $all->merge($applicants)
            ->merge($clients)
            ->merge($contracts);

        $all = $all->sortBy('label');

        return response()->json($all);
    }
}
