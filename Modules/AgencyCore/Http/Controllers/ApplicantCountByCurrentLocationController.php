<?php

namespace Modules\AgencyCore\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\AgencyCore\Entities\Applicant;

class ApplicantCountByCurrentLocationController extends Controller
{
    public function __invoke() {
        return Applicant::select([
                                     'id',
                                     'current_country',
                                     'status',
                                     'is_approved',
                                     'date_of_birth',
                                 ])
                        ->where('is_approved',
                                true)
                        ->where('status',
                                'active')
                        ->get()
                        ->groupBy('current_country')
                        ->reduce(function($carry, $collection) {
                            $carry[$collection->first()->current_country] = $collection->count();

                            return $carry;
                        },
                            []);
    }
}
