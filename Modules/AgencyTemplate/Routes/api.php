<?php

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

use Illuminate\Support\Facades\Route;
use Modules\AgencyTemplate\Http\Controllers\TemplateContractTypeController;
use Modules\AgencyTemplate\Http\Controllers\TemplateController;
use Modules\AgencyTemplate\Http\Controllers\TemplateSellableController;

Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'agencytemplate'],
    function() {
        Route::get('templates/all',
                   TemplateController::class."@all");

        Route::get('templates/tags',
                   TemplateController::class.'@tags');

        Route::get('templates/{template}/content',
                   TemplateController::class.'@getContent');

        Route::resource('templates',
                        TemplateController::class);

        Route::post('templates/sellables/{sellable}',
                    TemplateSellableController::class."@store");

        Route::get('templates/sellables/{sellable}/variants/{variant}',
                   TemplateSellableController::class."@getVariantTemplate");
        Route::get('templates/sellables/{sellable}',
                   TemplateSellableController::class."@getSellableTemplate");

        Route::post('templates/contract_types/{contract_type}',
                    TemplateContractTypeController::class."@assign");
        Route::get('templates/contract_types/{contract_type}',
                   TemplateContractTypeController::class."@index");
        Route::delete('templates/{template}/contract_types/{contractType}',
                      TemplateContractTypeController::class."@destroy");

    });
