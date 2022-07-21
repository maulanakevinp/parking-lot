<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return redirect('home');
});

Auth::routes();

Route::group(['middleware' => ['web','auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/paring/export', [ParkingController::class, 'export'])->name('parking.export');
    Route::resource('parking', ParkingController::class)->except('create','show','edit','destroy');
    Route::resource('setting', SettingController::class)->except('create','store','edit','show','destroy');
});
