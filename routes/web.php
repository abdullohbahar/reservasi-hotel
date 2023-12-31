<?php

use App\Models\Resepsionis;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\CekKamarController;
use App\Http\Controllers\DetailKamarController;
use App\Http\Controllers\ResepsionisController;
use App\Http\Controllers\TamuDefaultController;
use App\Mail\ForgotPasswordMail;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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



Route::get('tamu/detail', [DetailController::class, 'detailtamu']);
Route::get('kamar/detail/{id}', [DetailController::class, 'detailkamar']);

// User Route
Route::get('login/user', [UserController::class, 'index']);
Route::get('logout', [UserController::class, 'logout']);
Route::post('aksilogin/user', [UserController::class, 'aksilogin']);
Route::get('daftar/user', [UserController::class, 'daftaruserview']);
Route::get('lupapassword/user', [UserController::class, 'lupapasswordview']);
Route::get('reset-password', [UserController::class, 'resetpasswordview']);
Route::post('aksi-reset-password', [UserController::class, 'aksiresetpassword']);
// User Route Simpan
Route::post('userstore/tamu', [UserController::class, 'userstore']);

// Admin Route
Route::get('dashboard/admin', [AdminController::class, 'index']);
// -Resepsionis
Route::get('listresepsionis/admin', [AdminController::class, 'listresepsionis']);
Route::get('editresepsionis/admin', [AdminController::class, 'editresepsionis']);
// Admin Route Simpan
Route::post('storeresepsionis/admin', [AdminController::class, 'resepsionisstore']);
Route::post('updateresepsionis/admin', [AdminController::class, 'updateresepsionis']);
Route::get('destroyresepsionis/{id}', [AdminController::class, 'resepsionisdestroy']);
Route::get('get-resepsionis/{id}', [AdminController::class, 'getResepsionis']);

// -Kamar
Route::get('listkamar/admin', [AdminController::class, 'listkamar']);
Route::get('editkamar/admin', [AdminController::class, 'editkamar']);

// Kamar Route Simpan
Route::post('storetipekamar/admin', [AdminController::class, 'tipekamarstore']);
Route::post('storekamar/admin', [AdminController::class, 'kamarstore']);
Route::post('updatenokamar/admin', [AdminController::class, 'updatenokamar']);
Route::post('updatetipekamar/admin', [AdminController::class, 'updatetipekamar']);
Route::get('get-tipekamar/{id}', [AdminController::class, 'gettipekamar']);

Route::get('destroynokamar/{id}', [AdminController::class, 'destroynokamar']);
Route::get('destroytipekamar/{id}', [AdminController::class, 'destroytipekamar']);



// -Laporan
Route::get('laporan/absen/admin', [AdminController::class, 'absenview']);
Route::get('laporan/pendapatan/admin', [AdminController::class, 'pendapatanview']);

// Tamu Route :

// Default
Route::get('/', [TamuDefaultController::class, 'default']);
Route::get('dashboard/tamudefault', [TamuDefaultController::class, 'default']);
Route::get('pesankamar/tamudefault', [TamuDefaultController::class, 'pesankamardefault']);
Route::get('pembayaran/tamudefault', [TamuDefaultController::class, 'pembayarandefault']);

// User
Route::get('profil/tamu', [TamuController::class, 'profil']);
Route::put('ubahprofile/tamu/{id}', [TamuController::class, 'ubahProfile']);
Route::put('ubahfoto/tamu/{id}', [TamuController::class, 'ubahFoto']);
Route::get('dashboard/tamu', [TamuController::class, 'dashboard']);
Route::get('pesankamar/tamu', [TamuController::class, 'pesankamar']);
Route::post('bookingkamar/tamu', [TamuController::class, 'bookingKamar']);
Route::get('/cekkamartersedia/{checkin}/{checkout}/{tipeKamar}', CekKamarController::class);
Route::get('pembayaran/tamu/{id}', [TamuController::class, 'pembayaran']);
Route::put('simpanpembayaran/tamu/{id}', [TamuController::class, 'simpanPembayaran']);
Route::get('riwayat/tamu', [TamuController::class, 'riwayat']);


// Resepsionis Route
Route::get('dashboard/resepsionis', [ResepsionisController::class, 'index']);
Route::get('absen/resepsionis', [ResepsionisController::class, 'absenresepsionis']);
Route::post('simpan-absen/resepsionis', [ResepsionisController::class, 'simpanabsen']);
Route::get('list/resepsionis', [ResepsionisController::class, 'listtamukamar']);
Route::get('konifrmasi-checkout/resepsionis/{id}', [ResepsionisController::class, 'checkout']);
Route::get('laporan/resepsionis', [ResepsionisController::class, 'laporanresepsionis']);
Route::post('simpan-pendapatan-lainnya/resepsionis', [ResepsionisController::class, 'simpanPendapatanLainnya']);
Route::get('profil/resepsionis', [ResepsionisController::class, 'profilresepsionis']);

// Reservasi Online
Route::get('pesan/resepsionis', [ResepsionisController::class, 'ronpesan']);
Route::get('konfirmasi-pesan/resepsionis/{id}', [ResepsionisController::class, 'konfirmasi']);
Route::post('tolak-pesan/resepsionis', [ResepsionisController::class, 'tolak']);
Route::get('nobooking/resepsionis', [ResepsionisController::class, 'ronnobooking']);
Route::get('konfirmasi-nobooking/resepsions/{id}', [ResepsionisController::class, 'konfirmasiNobooking']);

// Reservasi Office
Route::get('daftar/resepsionis', [ResepsionisController::class, 'rofdaftar']);
Route::get('pembayaran/resepsionis', [ResepsionisController::class, 'rofpembayaran']);
// Reservasi Office Simpan
Route::post('storetamu/resepsionis', [ResepsionisController::class, 'rofstore']);

Route::get('get-tipe-kamar-price/{id}', [ResepsionisController::class, 'GetTipeKamarPrice']);
Route::get('pendapatan-lainnya/resepsionis', [ResepsionisController::class, 'tambahPendapatanLainnya']);

Route::post('/send-email', [UserController::class, 'kirimemail']);

Route::get('unduh-struk/{id}', [TamuController::class, 'downloadStruk']);
