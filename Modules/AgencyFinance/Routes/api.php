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
use Modules\AgencyFinance\Http\Controllers\CreditNoteController;
use Modules\AgencyFinance\Http\Controllers\InvoiceController;
use Modules\AgencyFinance\Http\Controllers\MetricController;
use Modules\AgencyFinance\Http\Controllers\PaymentController;

Route::group(['middleware' => 'auth:sanctum', 'prefix' => '/agencyfinance'],
    function() {

        Route::get('metrics/current_month_total',
                   [MetricController::class, 'currentMonthTotalPayment']);
        Route::get('metrics/current_month_total_dataset',
                   [MetricController::class, 'currentMonthTotalPaymentDataset']);

        Route::resource('credit_notes',
                        CreditNoteController::class,
                        ['except' => ['edit']]);

        Route::post('invoices/{invoice}/supersede',
                    InvoiceController::class.'@supersede');

        Route::get('invoices/{invoice}/trail',
                   InvoiceController::class.'@trail');

        Route::resource('invoices',
                        InvoiceController::class,
                        ['except' => ['edit']]);

        Route::resource('payments',
                        PaymentController::class,
                        ['except' => ['create', 'edit']]);

    });
