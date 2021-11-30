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

Route::group(['middleware'=>'hasToken'],function () {
    Route::get('user', 'Auth\LoginController@user');
    Route::post('score','Api\ScoreController@score');
    Route::get('highScore','Api\ScoreController@highScore');
    Route::post('recharge','Api\BalanceController@recharge');
    Route::post('purchase','Api\TransactionController@purchase');
});


Route::post('sendNotification','Api\ScoreController@sendNotification');

Route::get('receiveNotification','Api\ScoreController@receiveNotification');

