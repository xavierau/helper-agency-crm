<?php

use App\Http\Controllers\SettingController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\AgencyCore\Entities\Applicant;
use Modules\AgencyCore\Http\Controllers\SearchController;

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


Route::group(['middleware' => 'auth:sanctum'],
    function () {
        Route::get('is_login',
            fn() => response('', 204));

        Route::get('/user',
            function (Request $request) {
                $user = $request->user();
                $user->load('roles.permissions');

                return response()->json(new UserResource($user));
            });

        Route::get('/search', SearchController::class);

        Route::resource('/settings', SettingController::class);

        Route::get('/aggregates/applicants/pending_approval', fn() => Applicant::where('is_approved', false)->count());
    });
