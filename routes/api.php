<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use CloudCreativity\LaravelJsonApi\Facades\JsonApi;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('companiesAPI', 'App\Http\Controllers\Company\CompanyApiController', ['except' => [
    'create', 'edit', 'update']])->parameters([
    'companiesAPI' => 'company',
]);
Route::post('companiesAPI/{company}', 'App\Http\Controllers\Company\CompanyApiController@update')->name('companies.update');
Route::resource('companiesAPI.employeesAPI', 'App\Http\Controllers\Employee\EmployeeApiController', ['except' => [
    'index', 'create', 'edit']])->parameters([
        'companiesAPI' => 'company',
        'employeesAPI' => 'employee'
    ]);

Route::get('employeesAPI', 'App\Http\Controllers\Employee\EmployeeApiController@employees')->name('employees');

// JsonApi::register('default')->withNamespace('Api')->routes(function ($api) {
//     $api->resource('companies');
//     $api->resource('employees');
// });
