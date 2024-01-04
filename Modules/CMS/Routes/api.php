<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/cms',
    function(Request $request) {
        return $request->user();
    });


Route::group(['middleware' => 'auth:sanctum', 'prefix' => '/cms'],
    function() {
        Route::get('/pages',
                   'PagesController');

        Route::get('/news',
                   'NewsController@index');
        Route::post('/news',
                    'NewsController@store');
        Route::get('/news/{news}',
                   'NewsController@show');
        Route::put('/news/{news}',
                   'NewsController@update');

        Route::get('/pages/{page}/contents',
                   'GetPageContentsController');

        Route::put('/pages/{page}/contents/{key}',
                   'UpdatePageContentController');

        Route::get('/common_contents',
                   'GetCommonContentsController');
        Route::get('/common_contents/{key}',
                   'ShowCommonContentController');

        Route::put('/common_contents/{key}',
                   'UpdateCommonContentsController');
    });
