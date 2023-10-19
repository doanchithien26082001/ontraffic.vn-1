<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

Route::get('/random', 'UserController@random');
// Route Users
Route::group(['prefix' => 'laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
Auth::routes();
Route::get('/export-excel', 'ExcelController@export')->name('export-excel');
Route::get('/', 'UserController@userLogin')->name('userLogin');
Route::get('/run', 'UserController@run');
Route::post('/user-register', 'UserController@userHandleRegister')->name('userHandleRegister');
Route::post('/user-login', 'UserController@userHandlelogin')->name('userHandlelogin');
Route::post('/user-reset-password', 'UserController@userHandleResetPassword')->name('userHandleResetPassword');
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', 'UserController@userDashboard')->name('userDashboard');
    Route::get('/logout', 'UserController@userHandleLogout')->name('userHandleLogout');
    Route::get('/acount', 'UserController@userAcount')->name('userAcount');
    Route::post('/user-update-info', 'UserController@userHandleUpdateInfo')->name('userHandleUpdateInfo');
    Route::post('/user-update-password', 'UserController@userHandleUpdatePassword')->name('userHandleUpdatePassword');
    Route::get('/payment', 'UserController@userPayment')->name('userPayment');
    Route::get('/support', 'UserController@userSupport')->name('userSupport');
    Route::post('/render-support', 'UserController@renderSupport')->name('renderSupport');
    Route::get('/support/{id}', 'UserController@getSupportById')->name('getSupportById');
    Route::get('/create-support', 'UserController@createSupport')->name('createSupport');
    Route::post('/user-response/{id}', 'UserController@userResponse')->name('userResponse');
    Route::get('/completed-response/{id}', 'UserController@completedSupport')->name('completedSupport');
    Route::post('/find-history', 'UserController@findHistory');
    Route::post('/handle-support', 'UserController@handleSupport');
    Route::get('/create-traffic', 'TrafficController@createTraffic')->name('createTraffic');
    Route::post('/handle-create-traffic', 'TrafficController@handleCreateTraffic')->name('handleCreateTraffic');
    Route::post('/get-onsite-price', 'TrafficController@getOnsitePrice')->name('getOnsitePrice');
    Route::post('/get-total-buy-traffic', 'TrafficController@getTotalBuyTraffic')->name('getTotalBuyTraffic');
});
// Route Admin
Route::get('/admin-website', 'AdminAuthController@adminLogin')->name('adminLogin');
Route::post('/admin/login', 'AdminAuthController@adminHandleLogin')->name('adminHandleLogin');
// Route::get('/admin/reset-password', 'AdminAuthController@adminResetPa')->name('userHandleResetPassword');
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', 'AdminAuthController@adminDashboard')->name('adminDashboard');
    Route::post('/admin/register', 'AdminAuthController@adminRegister')->name('adminRegister');
});
