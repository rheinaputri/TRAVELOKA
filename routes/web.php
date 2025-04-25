<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\KotaController;
use App\Http\Controllers\DestinasiController;
use App\Http\Controllers\FormpesanController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\WisatawanController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Di sini Anda bisa mendefinisikan semua route untuk aplikasi Anda.
| Semua route akan dimasukkan ke grup middleware "web".
*/

// Route untuk halaman utama (landing page)
Route::get('/', [WelcomeController::class, 'landing']);

// ------------------------------- Auth ----------------------------------

// Form login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Proses login
Route::post('/login', [AuthController::class, 'login']);

// Halaman dashboard (hanya bisa diakses oleh admin)
Route::get('/dashboard', function () {
    return view('welcome');
})->middleware('checkAdmin');

// ------------------------------- Welcome -------------------------------

// Route ke halaman utama WelcomeController
Route::get('/index', [WelcomeController::class, 'index']);

// ------------------------------- Kota ----------------------------------

Route::group(['prefix' => 'kota'], function () {
    Route::get('/', [KotaController::class, 'index'])->name('kota.index');                                      // Menampilkan halaman daftar kota
    Route::get('/list', [KotaController::class, 'list'])->name('kota.list');                                    // Mengambil data kota (untuk AJAX)
    Route::get('/create_ajax', [KotaController::class, 'create_ajax'])->name('kota.create_ajax');               // Form tambah kota (AJAX)
    Route::post('/ajax', [KotaController::class, 'store_ajax'])->name('store_ajax');                            // Menyimpan data kota (AJAX)
    Route::get('/{id}/show_ajax', [KotaController::class, 'show_ajax'])->name('kota.show_ajax');                // Detail kota (AJAX)
    Route::get('/{id}/edit_ajax', [KotaController::class, 'edit_ajax'])->name('kota.edit_ajax');                // Form edit kota (AJAX)
    Route::put('/{id}/update_ajax', [KotaController::class, 'update_ajax'])->name('kota.update_ajax');          // Update data kota (AJAX)
    Route::get('/{id}/delete_ajax', [KotaController::class, 'confirm_ajax'])->name('kota.confirm_ajax');        // Konfirmasi hapus kota (AJAX)
    Route::delete('/{id}/delete_ajax', [KotaController::class, 'delete_ajax']);                                 // Hapus data kota (AJAX)
});

// ------------------------------- Paket ---------------------------------

Route::group(['prefix' => 'paket'], function () {
    Route::get('/', [PaketController::class, 'index'])->name('paket.index');
    Route::get('/indexpaket', [PaketController::class, 'indexpaket'])->name('paket.indexpaket');                                    // Menampilkan halaman daftar paket
    Route::get('/list', [PaketController::class, 'list'])->name('paket.list');                                  // Mengambil data paket (AJAX)
    Route::get('/create_ajax', [PaketController::class, 'create_ajax'])->name('paket.create_ajax');             // Form tambah paket (AJAX)
    Route::post('/ajax', [PaketController::class, 'store_ajax'])->name('store_ajax');                           // Simpan data paket (AJAX)
    Route::get('/{id}/show_ajax', [PaketController::class, 'show_ajax'])->name('paket.show_ajax');              // Detail paket (AJAX)
    Route::get('/{id}/edit_ajax', [PaketController::class, 'edit_ajax'])->name('paket.edit_ajax');              // Form edit paket (AJAX)
    Route::put('/{id}/update_ajax', [PaketController::class, 'update_ajax'])->name('paket.update_ajax');        // Update data paket (AJAX)
    Route::get('/{id}/delete_ajax', [PaketController::class, 'confirm_ajax'])->name('paket.confirm_ajax');      // Konfirmasi hapus paket (AJAX)
    Route::delete('/{id}/delete_ajax', [PaketController::class, 'delete_ajax'])->name('paket.delete_ajax');     // Hapus data paket (AJAX)
});

// ----------------------------- Destinasi ------------------------------

Route::group(['prefix' => 'destinasi'], function () {
    Route::get('/', [DestinasiController::class, 'index'])->name('destinasi.index');
    Route::get('/indexweb', [DestinasiController::class, 'indexweb'])->name('destinasi.indexweb');                                // Menampilkan halaman daftar destinasi                                // Menampilkan halaman daftar destinasi
    Route::get('/list', [DestinasiController::class, 'list'])->name('destinasi.list');                              // Mengambil data destinasi (AJAX)
    Route::get('/create_ajax', [DestinasiController::class, 'create_ajax'])->name('destinasi.create_ajax');         // Form tambah destinasi (AJAX)
    Route::post('/ajax', [DestinasiController::class, 'store_ajax'])->name('destinasi.store_ajax');                 // Simpan data destinasi (AJAX)
    Route::get('/{id}/show_ajax', [DestinasiController::class, 'show_ajax'])->name('destinasi.show_ajax');          // Detail destinasi (AJAX)
    Route::get('/{id}/edit_ajax', [DestinasiController::class, 'edit_ajax'])->name('destinasi.edit_ajax');          // Form edit destinasi (AJAX)
    Route::put('/{id}/update_ajax', [DestinasiController::class, 'update_ajax'])->name('destinasi.update_ajax');    // Update data destinasi (AJAX)
    Route::get('/{id}/delete_ajax', [DestinasiController::class, 'confirm_ajax'])->name('destinasi.confirm_ajax');  // Konfirmasi hapus destinasi (AJAX)
    Route::delete('/{id}/delete_ajax', [DestinasiController::class, 'delete_ajax'])->name('destinasi.delete_ajax'); // Hapus data destinasi (AJAX)
});

// ----------------------------- Wisatawan ------------------------------

Route::group(['prefix' => 'wisatawan'], function () {
    Route::get('/', [WisatawanController::class, 'index'])->name('wisatawan.index');
    Route::get('/', [WisatawanController::class, 'index2'])->name('wisatawan.index2');                                // Halaman utama wisatawan                                // Halaman utama wisatawan
    Route::get('/list', [WisatawanController::class, 'list'])->name('wisatawan.list');                              // Mengambil data wisatawan (AJAX)
    Route::get('/create_ajax', [WisatawanController::class, 'create_ajax'])->name('wisatawan.create_ajax');         // Form tambah wisatawan (AJAX)
    Route::post('/ajax', [WisatawanController::class, 'store_ajax'])->name('wisatawan.store_ajax');                 // Simpan data wisatawan (AJAX)
    Route::get('/{id}/edit_ajax', [WisatawanController::class, 'edit_ajax'])->name('wisatawan.edit_ajax');          // Form edit wisatawan (AJAX)
    Route::put('/{id}/update_ajax', [WisatawanController::class, 'update_ajax'])->name('wisatawan.update_ajax');    // Update data wisatawan (AJAX)
    Route::get('/{id}/show_ajax', [WisatawanController::class, 'show_ajax'])->name('wisatawan.show_ajax');          // Detail wisatawan (AJAX)
    Route::get('/{id}/delete_ajax', [WisatawanController::class, 'confirm_ajax'])->name('wisatawan.confirm_ajax');  // Konfirmasi hapus wisatawan (AJAX)
    Route::delete('/{id}/delete_ajax', [WisatawanController::class, 'delete_ajax'])->name('wisatawan.delete_ajax'); // Hapus data wisatawan (AJAX)
});

// ----------------------------- Pemesanan ------------------------------

Route::group(['prefix' => 'pemesanan'], function () {
    Route::get('/', [PemesananController::class, 'index'])->name('pemesanan.index');
    // Route::get('/', [PemesananController::class, 'index2'])->name('pemesanan.index2'); // Halaman utama pemesanan // Halaman utama pemesanan
    Route::get('/list', [PemesananController::class, 'list'])->name('pemesanan.list');                               // Mengambil data pemesanan (AJAX)
    Route::get('/create_ajax', [PemesananController::class, 'create_ajax'])->name('pemesanan.create_ajax');          // Form tambah pemesanan (AJAX)
    Route::post('/ajax', [PemesananController::class, 'store_ajax'])->name('pemesanan.store_ajax');                  // Simpan data pemesanan (AJAX)
    Route::get('/{id}/edit_ajax', [PemesananController::class, 'edit_ajax'])->name('pemesanan.edit_ajax');           // Form edit pemesanan (AJAX)
    Route::put('/{id}/update_ajax', [PemesananController::class, 'update_ajax'])->name('pemesanan.update_ajax');     // Update data pemesanan (AJAX)
    Route::get('/{id}/show_ajax', [PemesananController::class, 'show_ajax'])->name('pemesanan.show_ajax');           // Detail pemesanan (AJAX)
    Route::get('/{id}/delete_ajax', [PemesananController::class, 'confirm_ajax'])->name('pemesanan.confirm_ajax');   // Konfirmasi hapus pemesanan (AJAX)
    Route::delete('/{id}/delete_ajax', [PemesananController::class, 'delete_ajax'])->name('pemesanan.delete_ajax');  // Hapus data pemesanan (AJAX)
});



// Route::group(['prefix' => 'pesan'], function () {
//     Route::get('/', [PesanController::class, 'indexpesan'])->name('pesan.indexpesan'); // Halaman utama pesan
//     Route::get('/list', [PesanController::class, 'list'])->name('pesan.list'); // Mengambil data pesan (AJAX)
//     Route::get('/create_ajax', [PesanController::class, 'create_ajax'])->name('pesan.create_ajax'); // Form tambah pesan (AJAX)
//     Route::post('/ajax', [PesanController::class, 'store_ajax'])->name('pesan.store_ajax'); // Simpan data pesan (AJAX)
//     Route::get('/{id}/edit_ajax', [PesanController::class, 'edit_ajax'])->name('pesan.edit_ajax'); // Form edit pesan (AJAX)
//     Route::put('/{id}/update_ajax', [PesanController::class, 'update_ajax'])->name('pesan.update_ajax'); // Update data pesan (AJAX)
//     Route::get('/{id}/show_ajax', [PesanController::class, 'show_ajax'])->name('pesan.show_ajax'); // Detail pesan (AJAX)
//     Route::get('/{id}/delete_ajax', [PesanController::class, 'confirm_ajax'])->name('pesan.confirm_ajax'); // Konfirmasi hapus pesan (AJAX)
//     Route::delete('/{id}/delete_ajax', [PesanController::class, 'delete_ajax'])->name('pesan.delete_ajax'); // Hapus data pesan (AJAX)
// });


Route::group(['prefix' => 'formpesan'], function () {
    Route::get('/', [FormpesanController::class, 'index'])->name('formpesan.index');
    // Route::get('/', [FormpesanController::class, 'index2'])->name('formpesan.index2'); // Halaman utama pemesanan
    Route::get('/list', [FormpesanController::class, 'list'])->name('formpesan.list'); // Mengambil data pemesanan (AJAX)
    Route::get('/create_ajax', [FormpesanController::class, 'create_ajax'])->name('formpesan.create_ajax'); // Form tambah pemesanan (AJAX)
    Route::post('/ajax', [FormpesanController::class, 'store_ajax'])->name('formpesan.store_ajax'); // Simpan data pemesanan (AJAX)
    Route::get('/{id}/edit_ajax', [FormpesanController::class, 'edit_ajax'])->name('formpesan.edit_ajax'); // Form edit pemesanan (AJAX)
    Route::put('/{id}/update_ajax', [FormpesanController::class, 'update_ajax'])->name('formpesan.update_ajax'); // Update data pemesanan (AJAX)
    Route::get('/{id}/show_ajax', [FormpesanController::class, 'show_ajax'])->name('formpesan.show_ajax'); // Detail pemesanan (AJAX)
    Route::get('/{id}/delete_ajax', [FormpesanController::class, 'confirm_ajax'])->name('formpesan.confirm_ajax'); // Konfirmasi hapus pemesanan (AJAX)
    Route::delete('/{id}/delete_ajax', [FormpesanController::class, 'delete_ajax'])->name('formpesan.delete_ajax'); // Hapus data pemesanan (AJAX)
});
