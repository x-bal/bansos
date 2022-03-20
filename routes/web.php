<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\RfidController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    // Route Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route Master User
    Route::resource('user', UserController::class);

    // Route Master Warga
    Route::get('/get-warga', [WargaController::class, 'get_warga'])->name('warga.get');
    Route::post('/warga/jenis', [WargaController::class, 'store_jenis'])->name('warga.jenis');
    Route::post('/warga/{warga:id}/update-bantuan', [WargaController::class, 'update_bantuan'])->name('warga.update-bantuan');
    Route::resource('warga', WargaController::class);

    // Route Master Jenis
    Route::resource('jenis', JenisController::class);

    // Route Master Jadawl
    Route::resource('jadwal', JadwalController::class);

    // Route Data Device
    Route::resource('device', DeviceController::class);

    // Route Rfid
    Route::get('rfid', RfidController::class)->name('rfid.show');

    // Route Data Kehadirna
    Route::resource('kehadiran', KehadiranController::class);

    // Route Setting
    Route::get('/setting', [DashboardController::class, 'setting'])->name('setting');
    Route::post('/setting', [DashboardController::class, 'update_setting'])->name('setting.update');
});
