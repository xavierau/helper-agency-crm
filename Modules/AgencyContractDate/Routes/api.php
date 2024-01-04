<?php

use Illuminate\Support\Facades\Route;
use Modules\AgencyContractDate\Http\Controllers\ContractDateController;

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

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'agencycontractdate'],
    function() {

        Route::post('ordering',
                    ContractDateController::class."@ordering");
        Route::post('assign',
                    ContractDateController::class."@assign");
        Route::get('all_dates',
                   ContractDateController::class."@all");
        Route::resource('contract_dates',
                        ContractDateController::class);

    });
