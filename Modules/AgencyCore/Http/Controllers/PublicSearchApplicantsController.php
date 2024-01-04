<?php

namespace Modules\AgencyCore\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\AgencyCore\Entities\Applicant;
use Modules\AgencyCore\Transformers\ApplicantPaginatorResource;

class PublicSearchApplicantsController extends Controller
{
    public function __invoke(Request $request)
    {
        $paginator = Applicant::available()
            ->with('experiences.duties')
            ->when($request->query('nationality'), fn($q, $keyword) => $q->nationality($keyword))
            ->when($request->query('current_country'),
                function ($query, $keyword) {
                    return $query->where('current_country',
                        'like',
                        "%{$keyword}%");
                })
            ->when($request->query('applicant_ref_number'),
                function ($query, $keyword) {
                    return $query->where('hk_code',
                        'like',
                        "%{$keyword}%");
                })
            ->when($request->query('overseas_experience'),
                function ($query, $keyword) {
                    return $query->whereHas('experiences',
                        function ($sq) use ($keyword) {
                            return $sq->where('location',
                                'like',
                                "%{$keyword}%");

                        });
                })
            ->when($request->query('duties'),
                function ($query, $keyword) {
                    return $query->whereHas('duties',
                        function ($sq) use ($keyword) {
                            return $sq->where('id',
                                $keyword);

                        });
                })
            ->where(($request->query('min_height') || $request->query('max_height')),
                function ($query) use ($request) {
                    return $query->whereBetween('height', [$request->query('min_height') ?? 0, $request->query('max_height') ?? PHP_INT_MAX]);
                })
            ->where(($request->query('min_weight') || $request->query('max_weight')),
                function ($query) use ($request) {
                    return $query->whereBetween('weight',
                        [$request->query('min_weight') ?? 0, $request->query('max_weight') ?? PHP_INT_MAX]);
                })
            ->paginate(10);

        dd($paginator);

        return new ApplicantPaginatorResource($paginator);
    }
}
