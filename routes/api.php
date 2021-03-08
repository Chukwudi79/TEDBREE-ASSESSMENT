<?php

// namespace App\Http\Controllers;

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


// AUTHENTICATION ROUTES
Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('login', 'App\Http\Controllers\AuthController@login')->name('loging');
    Route::post('register', 'App\Http\Controllers\AuthController@register')->name('register');
});

// BUSINESS ROUTES
Route::post('my/jobs', 'App\Http\Controllers\JobController@store');
Route::get('my/jobs', 'App\Http\Controllers\JobController@index');
Route::get('my/jobs/{job_id}', 'App\Http\Controllers\JobController@show');
Route::put('my/jobs/{job_id}', 'App\Http\Controllers\JobController@update');
Route::delete('my/jobs/{job_id}', 'App\Http\Controllers\JobController@destroy');
Route::get('my/jobs/{job_id}/applications', 'App\Http\Controllers\JobController@applications');

//GUEST ROUTES
Route::prefix('jobs')->group(function () {
    Route::get('/', 'App\Http\Controllers\JobController@index');
    Route::get('/{job_id}', 'App\Http\Controllers\JobController@show');
    Route::post('/{job_id}/apply', 'App\Http\Controllers\ApplicantController@store');
});

// SEARCH ROUTE
Route::post('/my/jobs?{q}', 'App\Http\Controllers\JobController@search');


//SELECT OPTIONS ROUTES
Route::apiResource('category', 'App\Http\Controllers\CategoryController');
Route::apiResource('job/type', 'App\Http\Controllers\JobtypeController');
Route::apiResource('work/condition', 'App\Http\Controllers\WorkconditionController');
