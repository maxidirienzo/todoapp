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
Route::get('/todotasks', 'TodotasksController@todotasks');
Route::get('/todotask/{id}', 'TodotasksController@todotask')->where('id', '[0-9]+');
Route::delete('/todotask/delete/{id}', 'TodotasksController@deleteTodotask')->where('id', '[0-9]+');
Route::put('/todotask/put/{id}', 'TodotasksController@putTodotask')->where('id', '[0-9]+');
Route::post('/todotask/post', 'TodotasksController@postTodotask');

