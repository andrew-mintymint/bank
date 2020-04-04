<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'IndexController@index');
Route::get('/transfer-money', 'IndexController@transferMoney')->name('transfer_money');
Route::post('/transfer-money', 'IndexController@transferMoneyStore')->name('transfer_money_store');

Auth::routes(['verify' => true]);


Route::group(['middleware'=>'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/home/change-password', 'HomeController@changePassword')->name('home.change_password');
    Route::post('/home/update-avatar', 'HomeController@updateAvatar')->name('home.update_avatar');

    Route::get('generate-card-number', function () {
        return response()->json([
            'card' => \Auth::user()->generateCardNumber()
        ]);
    });

    Route::resource('credit_cards', 'CreditCardController');

    Route::group([ 'prefix' => 'admin', 'middleware' => 'admin', 'as' => 'admin.' ], function () {
        Route::get('users', 'AdminController@users')->name('users');
        Route::get('transactions', 'AdminController@transactions')->name('transactions');
    });
});
