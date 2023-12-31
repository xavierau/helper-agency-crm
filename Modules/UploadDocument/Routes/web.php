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

Route::prefix('files')->group(function() {
    Route::get('/{file_name}',
        function($fileName) {

            $path = 'app/files/'.$fileName;

            return response()->file(storage_path($path));
        }
    )->middleware('auth');
});
