<?php

namespace Modules\AgencyCore\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\AgencyCore\Entities\Applicant;

class ShowApplicantProfileController extends Controller
{

    public function __invoke(string $hash)
    {

        $applicant = Applicant::where('random_identifier', $hash)
            ->first();

        app()->setLocale('zh');

        return view('agencycore::applicants.profile',
            compact('applicant'));
    }
}
