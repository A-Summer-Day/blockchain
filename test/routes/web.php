<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');
Route::get('/wallets/{wallet}', 'HomeController@getWalletDetails')->name('wallet-details');
Route::get('/open-form/{wallet_id}/{address}', 'HomeController@openSendMoneyForm')->name('open-form');
Route::post('/send-money', 'HomeController@sendMoney')->name('send-money');

