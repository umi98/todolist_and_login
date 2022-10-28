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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'auth'
], function(){
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('signup', 'App\Http\Controllers\AuthController@signup');
    Route::group([
        'middleware' => 'auth:api'
    ], function(){
        Route::post('logout', 'App\Http\Controllers\AuthController@logout');
        Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
        Route::get('data', 'App\Http\Controllers\AuthController@data');

        
    });
});

Route::group([
    'prefix' => 'todo'
], function(){
    Route::group([
        'middleware' => 'auth:api'
    ], function(){
        Route::get('showtask', 'App\Http\Controllers\TodoController@showTask');
        Route::get('viewtask/{id}', 'App\Http\Controllers\TodoController@viewTask');
        Route::post('addtask', 'App\Http\Controllers\TodoController@addTask');
        Route::post('updatetask/{id}', 'App\Http\Controllers\TodoController@updateTask');
        Route::post('deletetask/{id}', 'App\Http\Controllers\TodoController@deleteTask');
    });
});
