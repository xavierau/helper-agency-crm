<?php

namespace Modules\CMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Modules\AgencyCore\Entities\Applicant;

class SearchApplicantController extends Controller
{

    public function __invoke(Request $request): View
    {
        $paginator = $this->searchApplicants($request);
        return view("search_result", compact('paginator')
        );
    }

    private function searchApplicants(Request $request): LengthAwarePaginator
    {
        return Applicant::available()
            ->search($request)
            ->paginate(10);
    }
}
