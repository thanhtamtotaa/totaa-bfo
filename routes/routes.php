<?php

use Illuminate\Support\Facades\Route;
use Totaa\TotaaBfo\Http\Controllers\BfoInfoController;

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

Route::middleware(['web', 'auth', 'CheckAccount'])->group(function () {

    //Route Admin
    Route::redirect('admin', '/', 301);
    Route::group(['prefix' => 'admin'], function () {

        //Route quản lý thông tin BFO
        Route::redirect('member', '/', 301);
        Route::group(['prefix' => 'member'], function () {

            Route::get('bfo',  [BfoInfoController::class, 'index'])->name('admin.member.bfo');

        });

    });

});
