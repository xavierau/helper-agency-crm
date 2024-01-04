<?php

use Illuminate\Support\Facades\Route;
use Modules\AgencyContractDoc\Http\Controllers\ContractDocController;

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

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'agencycontractdoc'],
    function() {

        Route::post('ordering',
                    ContractDocController::class."@ordering");
        Route::post('assign',
                    ContractDocController::class."@assign");
        Route::get('all_docs',
                   ContractDocController::class."@all");
        Route::delete('remove_file',
                   ContractDocController::class."@removeFile");
        Route::resource('contract_docs',
                        ContractDocController::class);

    });
