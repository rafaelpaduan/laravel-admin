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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('System')->prefix('system')->group(function (){

    Route::get('/loadavg1m', 'SystemController@loadavg1m')->name('loadavg1m');
    Route::get('/loadavg5m', 'SystemController@loadavg5m')->name('loadavg5m');
    Route::get('/loadavg15m', 'SystemController@loadavg15m')->name('loadavg15m');
    Route::get('/systemtime', 'SystemController@systemTime')->name('systemtime');
    Route::get('/memoryused', 'SystemController@memoryUsed')->name('memoryused');
});
