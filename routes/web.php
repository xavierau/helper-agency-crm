<?php

use App\Imports\ApplicantExperienceImport;
use App\Imports\ApplicantImport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\AgencyContract\Entities\Contract;
use Modules\AgencyContract\Http\Controllers\ContractDocumentController;
use Modules\AgencyFinance\Http\Controllers\InvoiceController;
use Modules\CMS\Http\Controllers\CartController;

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

Route::post('/addToCart/{applicant}', [CartController::class, 'addToCart'])
    ->name('cart.store');

Route::get('applicants/import/test', function () {
    Excel::import(new ApplicantImport, storage_path('tmp/applicant_personal_info.csv'));
});

Route::get('applicants/import/experience', function () {
    Excel::import(new ApplicantExperienceImport, storage_path('tmp/applicant_experience.csv'));
});

Route::view('/app', 'app');

Route::view('agreement', 'templates.agreement');

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Auth::routes(['register' => false]);
});

Route::get(
    'agreement/pdf',
    function () {
        $pdf = app('dompdf.wrapper');
        $pdf->loadHTML(view('templates.agreement')->render());

        return $pdf->stream();
    });

Route::group(['middleware' => 'auth'], function () {
    Route::get(
        '/invoices/{invoice}/agreement/print',
        [InvoiceController::class, "printAgreement"]
    );

    Route::get(
        '/contracts/{contract}/documents/{document}',
        [ContractDocumentController::class, "show"]
    );

    Route::get(
        'contracts/{contract}/agreement',
        function (Contract $contract) {
            $pdf = \DomPDF::loadView(
                'templates.agreement',
                ['contract' => $contract]
            )
                ->setPaper('a4');

            return $pdf->stream('agreement.pdf');
        }
    );

    Route::get(
        'contracts/{contract}/job_memo',
        function (Contract $contract) {
            $pdf = \DomPDF::loadView(
                'templates.job_memo',
                ['contract' => $contract]
            )
                ->setPaper('a4');

            return $pdf->stream('job_memo.pdf');
        }
    );
}
);
