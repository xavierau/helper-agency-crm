<?php

use App\Nationality;
use Illuminate\Support\Facades\Route;
use Modules\AgencyCore\Entities\Applicant;
use Modules\AgencyCore\Entities\Client;
use Modules\AgencyCore\Entities\Contract;
use Modules\AgencyCore\Entities\Job;
use Modules\AgencyCore\Http\Controllers\AddApplicantThumbnailController;
use Modules\AgencyCore\Http\Controllers\ApplicantController;
use Modules\AgencyCore\Http\Controllers\ApplicantCountByCurrentLocationController;
use Modules\AgencyCore\Http\Controllers\ApplicantUploadDocumentController;
use Modules\AgencyCore\Http\Controllers\ClientAddressController;
use Modules\AgencyCore\Http\Controllers\ClientContractController;
use Modules\AgencyCore\Http\Controllers\ClientController;
use Modules\AgencyCore\Http\Controllers\ClientJobController;
use Modules\AgencyCore\Http\Controllers\ContractController;
use Modules\AgencyCore\Http\Controllers\ContractDateController;
use Modules\AgencyCore\Http\Controllers\ContractDateGroupController;
use Modules\AgencyCore\Http\Controllers\DomesticDutyController;
use Modules\AgencyCore\Http\Controllers\ImportApplicantsController;
use Modules\AgencyCore\Http\Controllers\JobCommentController;
use Modules\AgencyCore\Http\Controllers\JobController;
use Modules\AgencyCore\Http\Controllers\JobRequirementController;
use Modules\AgencyCore\Http\Controllers\PublicSearchApplicantsController;
use Modules\AgencyCore\Http\Controllers\SellableController;
use Modules\AgencyCore\Http\Controllers\SellableVariantController;
use Modules\AgencyCore\Http\Controllers\SupplierController;
use Modules\AgencyCore\Http\Controllers\VariantController;
use Modules\AgencyFinance\Entities\Invoice;
use Modules\AgencyFinance\Entities\Payment;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/agencycore/nationalities',
    fn() => response()->json(Nationality::all()));

Route::post('/agencycore/applicants/registration',
    [ApplicantController::class, 'registration']);
Route::get('/agencycore/applicants/count/current_location',
    ApplicantCountByCurrentLocationController::class);
Route::get('/agencycore/public_search_applicants',
    PublicSearchApplicantsController::class);
Route::get('/agencycore/duties/all',
    DomesticDutyController::class . '@all');


// region After auth
Route::group(['middleware' => 'auth:sanctum', 'prefix' => "agencycore"],
    function () {

        Route::get('/entities',
            function () {
                return response()->json([
                    Applicant::class,
                    Client::class,
                    Contract::class,
                    Invoice::class,
                    Payment::class,
                    Job::class,
                ],);

            });

        Route::get('variants/all',
            VariantController::class . '@all');
        Route::resource('variants',
            VariantController::class);
        Route::resource('sellables.variants',
            SellableVariantController::class);
        Route::get('sellables/all',
            SellableController::class . "@all");
        Route::resource('sellables',
            SellableController::class);

        Route::put('clients/{client}/addresses/{address}',
            [ClientAddressController::class, 'update']);
        Route::get('clients/{client}/addresses',
            [ClientAddressController::class, 'index']);
        Route::resource('clients.contracts',
            ClientContractController::class);
        Route::post('clients/{client}/relatives',
            ClientController::class . "@postRelatives");
        Route::post('clients/{client}/jobs',
            ClientJobController::class . '@store');
        Route::resource('clients',
            ClientController::class);

        Route::resource('suppliers',
            SupplierController::class);

        // region Applicants

        Route::post('applicants/import', ImportApplicantsController::class);
        Route::post('applicants/experience/import', \Modules\AgencyCore\Http\Controllers\ImportApplicantExperienceController::class);

        Route::get('applicants/{applicant}/edit_personal_info', \Modules\AgencyCore\Http\Controllers\GetUpdateApplicantPersonalInfoController::class);

        Route::put('applicants/{applicant}/edit_personal_info', \Modules\AgencyCore\Http\Controllers\PutUpdateApplicantPersonalInfoController::class);

        Route::put('applicants/{applicant}/edit_basic_info', \Modules\AgencyCore\Http\Controllers\UpdateApplicantBasicInfoController::class);


        Route::get('applicants/available',
            [ApplicantController::class, 'getAvailable']);
        Route::post('applicants/{applicant}/thumbnail', AddApplicantThumbnailController::class);
        Route::post('applicants/{applicant}/full_body',
            [ApplicantController::class, 'addFullBodyPhoto']);
        Route::post('applicants/{applicant}/approve',
            [ApplicantController::class, 'approve']);


        Route::resource('applicants.uploaded_documents',
            ApplicantUploadDocumentController::class);

        Route::resource('applicants',
            ApplicantController::class);

        // endregion

        // region Jobs
        Route::post('jobs/{job}/update_requirement',
            [JobRequirementController::class, "update"]);
        Route::get('jobs/{job}/applicants/all',
            JobController::class . "@getAllAssignedApplicants");
        Route::post('jobs/{job}/applicants/email',
            JobController::class . "@emailApplicantToClient");
        Route::post('jobs/{job}/applicants/',
            JobController::class . "@assignedApplicant");
        Route::delete('jobs/{job}/applicants/{applicant}',
            JobController::class . "@removeApplicant");
        Route::resource('jobs.comments',
            JobCommentController::class);
        Route::resource('jobs',
            JobController::class);
        // endregion

        // region Duties
        Route::get('duties',
            DomesticDutyController::class . '@index');
        Route::post('duties',
            DomesticDutyController::class . '@store');
        Route::delete('duties/{duty}',
            DomesticDutyController::class . '@destroy');
        Route::put('duties/{duty}',
            DomesticDutyController::class . '@update');
        // endregion

        Route::post('new_client_and_job',
            ClientController::class . "@newClientAndJob");
        Route::get('duties',
            DomesticDutyController::class . "@index");

        Route::resource('contract_date_groups',
            ContractDateGroupController::class);

    });

// endregion
