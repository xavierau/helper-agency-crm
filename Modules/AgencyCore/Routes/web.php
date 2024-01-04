<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Imports\ApplicantImport;
use Maatwebsite\Excel\Facades\Excel;
use Modules\AgencyCore\Http\Controllers\ShowApplicantProfileController;

Route::prefix('core')->group(function () {
    Route::get(
        'applicants/profile/{hash}',
        ShowApplicantProfileController::class
    );

    //    Route::get('applicants/{applicant}',
    //        function(Applicant $applicant) {
    //
    //            return view('agencycore::applicants.profile',
    //                        compact('applicant'));
    //
    //        });

});
