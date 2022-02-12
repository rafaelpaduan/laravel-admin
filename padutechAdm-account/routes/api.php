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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/user', 'UserController@index');
Route::get('/user/{id}', 'UserController@show');

Route::patch('/user/{id}', 'UserController@update');

Route::post('/user', 'UserController@store');

Route::delete('/user/{id}', 'UserController@destroy');

// Route::fallback(function(){

//     return response()->json([
    
//         'code' => 404,
//         'message' => 'Página não encontrada'
    
//     ], 404);
// });