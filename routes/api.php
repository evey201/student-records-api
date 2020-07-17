<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('students', 'StudentApiController@getAllStudents');
Route::get('students/{id}', 'StudentApiController@getStudent');
Route::post('students', 'StudentApiController@createStudent');
Route::post('students/{id}', 'StudentApiController@updateStudent');
Route::delete('students/{id}','StudentApiController@deleteStudent');
