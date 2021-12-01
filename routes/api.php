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

Route::post('login', 'Auth\LoginController@login');
Route::post('register','Auth\RegisterController@store')->name('register');
Route::get('user', 'Auth\LoginController@user');

Route::group(['namespace'=> 'Api', 'middleware'=>'api:sanctum'], function () {
    Route::post('score','ScoreController@score');
    Route::get('highScore','ScoreController@highScore');
    Route::post('recharge','BalanceController@recharge');
    Route::post('purchase','TransactionController@purchase');
});

