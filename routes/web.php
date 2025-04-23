<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\KotaController;
use App\Http\Controllers\DestinasiController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\WisatawanController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route LandingPage
Route::get('/', [WelcomeController::class, 'landing']);

// Route Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/dashboard', function () {
    return view('welcome');
})->middleware('checkAdmin');





// Route Welcome
Route::get('/index', [WelcomeController::class, 'index']);

// Route Kota
Route::group(['prefix' => 'kota'], function () {
    Route::get('/', [KotaController::class, 'index'])->name('kota.index');
    Route::get('/list', [KotaController::class, 'list'])->name('kota.list');
    Route::get('/create_ajax', [KotaController::class, 'create_ajax'])->name('kota.create_ajax');
    Route::post('/ajax', [KotaController::class, 'store_ajax'])->name('store_ajax');
    Route::get('/{id}/show_ajax', [KotaController::class, 'show_ajax'])->name('kota.show_ajax');
    Route::get('/{id}/edit_ajax', [KotaController::class, 'edit_ajax'])->name('kota.edit_ajax');
    Route::put('/{id}/update_ajax', [KotaController::class, 'update_ajax'])->name('kota.update_ajax');
    Route::get('/{id}/delete_ajax', [KotaController::class, 'confirm_ajax'])->name('kota.confirm_ajax');
    Route::delete('/{id}/delete_ajax', [KotaController::class, 'delete_ajax']);
});

// Route Paket
Route::group(['prefix' => 'paket'], function () {
    Route::get('/', [PaketController::class, 'index'])->name('paket.index');
    Route::get('/list', [PaketController::class, 'list'])->name('paket.list');
    Route::get('/create_ajax', [PaketController::class, 'create_ajax'])->name('paket.create_ajax');
    Route::post('/ajax', [PaketController::class, 'store_ajax'])->name('store_ajax');
    Route::get('/{id}/show_ajax', [PaketController::class, 'show_ajax'])->name('paket.show_ajax');
    Route::get('/{id}/edit_ajax', [PaketController::class, 'edit_ajax'])->name('paket.edit_ajax');
    Route::put('/{id}/update_ajax', [PaketController::class, 'update_ajax'])->name('paket.update_ajax');
    Route::get('/{id}/delete_ajax', [PaketController::class, 'confirm_ajax'])->name('paket.confirm_ajax');
    Route::delete('/{id}/delete_ajax', [PaketController::class, 'delete_ajax'])->name('paket.delete_ajax');
});

// Route Destinasi
Route::group(['prefix' => 'destinasi'], function () {
    Route::get('/', [DestinasiController::class, 'index'])->name('destinasi.index');
    Route::get('/list', [DestinasiController::class, 'list'])->name('destinasi.list');
    Route::get('/create_ajax', [DestinasiController::class, 'create_ajax'])->name('destinasi.create_ajax');
    Route::post('/ajax', [DestinasiController::class, 'store_ajax'])->name('destinasi.store_ajax');
    Route::get('/{id}/show_ajax', [DestinasiController::class, 'show_ajax'])->name('destinasi.show_ajax');
    Route::get('/{id}/edit_ajax', [DestinasiController::class, 'edit_ajax'])->name('destinasi.edit_ajax');
    Route::put('/{id}/update_ajax', [DestinasiController::class, 'update_ajax'])->name('destinasi.update_ajax');
    Route::get('/{id}/delete_ajax', [DestinasiController::class, 'confirm_ajax'])->name('destinasi.confirm_ajax');
    Route::delete('/{id}/delete_ajax', [DestinasiController::class, 'delete_ajax'])->name('destinasi.delete_ajax');
});

// Route wisatawan
Route::group(['prefix' => 'wisatawan'], function () {
    Route::get('/', [WisatawanController::class, 'index'])->name('wisatawan.index');
    Route::get('/list', [WisatawanController::class, 'list'])->name('wisatawan.list');
    Route::get('/create_ajax', [WisatawanController::class, 'create_ajax'])->name('wisatawan.create_ajax');
    Route::post('/ajax', [WisatawanController::class, 'store_ajax'])->name('wisatawan.store_ajax');
    Route::get('/{id}/edit_ajax', [WisatawanController::class, 'edit_ajax'])->name('wisatawan.edit_ajax');
    Route::put('/{id}/update_ajax', [WisatawanController::class, 'update_ajax'])->name('wisatawan.update_ajax');
    Route::get('/{id}/show_ajax', [WisatawanController::class, 'show_ajax'])->name('wisatawan.show_ajax');
    Route::get('/{id}/delete_ajax', [WisatawanController::class, 'confirm_ajax'])->name('wisatawan.confirm_ajax');
    Route::delete('/{id}/delete_ajax', [WisatawanController::class, 'delete_ajax'])->name('wisatawan.delete_ajax');
});

// Route Pemesanan
Route::group(['prefix' => 'pemesanan'], function () {
    Route::get('/', [PemesananController::class, 'index'])->name('pemesanan.index');
    Route::get('/list', [PemesananController::class, 'list'])->name('pemesanan.list');
    Route::get('/create_ajax', [PemesananController::class, 'create_ajax'])->name('pemesanan.create_ajax');
    Route::post('/ajax', [PemesananController::class, 'store_ajax'])->name('pemesanan.store_ajax');
    Route::get('/{id}/edit_ajax', [PemesananController::class, 'edit_ajax'])->name('pemesanan.edit_ajax');
    Route::put('/{id}/update_ajax', [PemesananController::class, 'update_ajax'])->name('pemesanan.update_ajax');
    Route::get('/{id}/show_ajax', [PemesananController::class, 'show_ajax'])->name('pemesanan.show_ajax');
    Route::get('/{id}/delete_ajax', [PemesananController::class, 'confirm_ajax'])->name('pemesanan.confirm_ajax');
    Route::delete('/{id}/delete_ajax', [PemesananController::class, 'delete_ajax'])->name('pemesanan.delete_ajax');
});

