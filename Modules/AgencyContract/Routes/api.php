<?php

use Illuminate\Support\Facades\Route;
use Modules\AgencyContract\Http\Controllers\ContractController;
use Modules\AgencyContract\Http\Controllers\ContractDateController;
use Modules\AgencyContract\Http\Controllers\ContractDocumentController;
use Modules\AgencyContract\Http\Controllers\ContractRequirementController;
use Modules\AgencyContract\Http\Controllers\ContractTypeController;
use Modules\AgencyContract\Http\Controllers\ContractUploadDocumentController;
use Modules\AgencyContract\Http\Controllers\ExpiringContractController;
use Modules\AgencyContract\Http\Controllers\MetricController;

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

Route::group([
                 'middleware' => 'auth:sanctum',
                 'prefix'     => 'agencycontract',
             ],
    function() {

        // Metrics
        Route::get('metrics/current_month_new',
                   [MetricController::class, 'currentMonthTotalNew']);

        // Contract Type
        Route::resource('contract_types',
                        ContractTypeController::class);

        // Transition
        Route::post('contracts/{contract}/transitions/{transition}',
                    ContractController::class."@transit");

        // Address
        Route::post('contracts/{contract}/add_address',
                    ContractController::class."@addAddress");

        // Dates
        Route::post('contracts/{contract}/dates',
                    ContractDateController::class."@addDate");
        Route::put('contracts/{contract}/dates',
                   ContractDateController::class."@updateDate");

        // Documents
        Route::post('contracts/{contract}/documents',
                    ContractDocumentController::class."@store");
        Route::post('contracts/{contract}/documents/upload',
                    ContractDocumentController::class."@update");
        Route::delete('contracts/{contract}/documents',
                      ContractDocumentController::class."@destroy");
        Route::get('contracts/{contract}/documents/{document}',
                   ContractDocumentController::class."@show");
        Route::delete('contracts/{contract}/documents/{document}',
                      ContractDocumentController::class."@removeFile");

        // Residents
        Route::post('contracts/{contract}/add_new_residents',
                    ContractController::class."@addNewResident");
        Route::post('contracts/{contract}/add_residents',
                    ContractController::class."@addResidents");

        Route::delete('contracts/{contract}/remove_residents/{client}',
                      ContractController::class."@removeResident");


        // Contract Requirements
        Route::post('contracts/{contract}/requirement',
                    [ContractRequirementController::class, 'update']);
        // Contract
        Route::resource('contracts',
                        ContractController::class);

        // Upload Documents
        Route::resource('contracts.uploaded_documents',
                        ContractUploadDocumentController::class);

        // Widgets

        Route::group(['prefix' => 'widgets'],
            function() {
                Route::get('expiring_contract',
                           ExpiringContractController::class);

            });

    });
