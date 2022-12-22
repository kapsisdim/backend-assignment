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

Route::name('api.v1.')
->namespace('App\\Http\\Controllers\\Api\\V1')
->prefix('v1')
->group(function () {

    // Auth
    Route::group(['prefix' => 'auth', 'name' => 'auth'], function () {
        Route::post('login', 'AuthController@login')->name('login');

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('logout', 'AuthController@logout')->name('logout');
        });
    });

    Route::group(['middleware' => 'auth:sanctum'], function () {
        // User
        Route::group(['prefix' => 'users', 'name' => 'users'], function () {
            Route::get('profile', 'UserController@profile')->name('profile');
        });

        // Vessels
        Route::middleware(['throttle:ip_address'])->resource('vessels', 'VesselController')->only('index', 'show');
    });
});
