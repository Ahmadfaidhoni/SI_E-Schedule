<?php

use App\Http\Controllers\ConfigController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\RubahJadwalController;
use App\Http\Middleware\CheckJadwalOwner;

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

Route::group(['middleware' => 'auth'], function () {

    // dashboard
    Route::get('/', [DashboardController::class, 'index']);

    // home
    Route::get('/jadwal', [JadwalController::class, 'index']);

    //jadwal
    Route::get('/history-jadwal', [JadwalController::class, 'history']);

    // export
    Route::get('/export-jadwal/{awal}/{akhir}/{user}/{tipe_jadwal}', [JadwalController::class, 'export_jadwal']);

    //perubahan jadwal
    Route::get('/perubahan-jadwal', [RubahJadwalController::class, 'index']);
    Route::get('/history-perubahan-jadwal', [RubahJadwalController::class, 'history_perubahan']);
    Route::get('{jadwal}.editJadwal', [RubahJadwalController::class, 'edit'])->middleware(CheckJadwalOwner::class);
    Route::patch('data-ubah-jadwal.{jadwal}', [RubahJadwalController::class, 'update']);

    //logout
    Route::post('/logout', [LoginController::class, 'logout']);

    // profil
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::get('editProfile', [ProfileController::class, 'edit']);
    Route::patch('profile.{user}', [ProfileController::class, 'update']);
    Route::post('change-password', [ProfileController::class, 'changePassword'])->name('change.password');
});

Route::group(['middleware' => 'keuangan'], function () {
    Route::get('/keuangan', [KeuanganController::class, 'index']);
    Route::get('/data-keuangan-pegawai-{user:nip}', [KeuanganController::class, 'show']);
    Route::get('/keuangan/excel/{awal}/{akhir}/{user}/{tipe_jadwal}/', [KeuanganController::class, 'export_excel']);
});

Route::group(['middleware' => 'admin'], function () {
    //pegawai
    Route::get('/data-pegawai', [UserController::class, 'index']);
    Route::get('data-pegawai-{user:nip}', [UserController::class, 'show']);
    Route::get('/add-pegawai', [UserController::class, 'create']);
    Route::post('/add-pegawai', [UserController::class, 'store']);
    Route::get('editPegawai-{pegawai:nip}', [UserController::class, 'edit']);
    Route::patch('data-pegawai.{pegawai}', [UserController::class, 'update']);
    Route::delete('data-pegawai.{pegawai}', [UserController::class, 'destroy']);
    Route::post('reset-password/{id}', [ProfileController::class, 'reset']);

    //kegiatan
    Route::get('/data-kegiatan', [KegiatanController::class, 'index']);
    Route::get('/add-kegiatan', [KegiatanController::class, 'create']);
    Route::post('/add-kegiatan', [KegiatanController::class, 'store']);
    Route::get('editKegiatan-{kegiatan:kode_kegiatan}', [KegiatanController::class, 'edit']);
    Route::patch('data-kegiatan.{kegiatan}', [KegiatanController::class, 'update']);
    Route::delete('data-kegiatan/{id}', [KegiatanController::class, 'destroy']);

    // ruangan
    Route::get('/data-ruangan', [RuanganController::class, 'index']);
    Route::get('/add-ruangan', [RuanganController::class, 'create']);
    Route::post('/add-ruangan', [RuanganController::class, 'store']);
    Route::get('editRuangan-{ruangan:id}', [RuanganController::class, 'edit']);
    Route::patch('data-ruangan.{ruangan}', [RuanganController::class, 'update']);
    Route::delete('data-ruangan/{id}', [RuanganController::class, 'destroy']);

    //config
    Route::get('/config', [ConfigController::class, 'index']);
    Route::post('/update_config', [ConfigController::class, 'update']);

    //jadwal
    Route::get('/add-jadwal', [JadwalController::class, 'create']);
    Route::post('/add-jadwal', [JadwalController::class, 'store']);
    Route::get('editJadwal-{jadwal:id}', [JadwalController::class, 'edit']);
    Route::patch('data-jadwal.{jadwal}', [JadwalController::class, 'update']);
    Route::delete('data-jadwal.{jadwal}', [JadwalController::class, 'destroy']);
    Route::get('data-jadwal-{jadwal:id}', [JadwalController::class, 'show']);
    Route::get('jadwal-{user:nip}', [JadwalController::class, 'showFull']);

    //ajax
    Route::get('/get-pegawai', [JadwalController::class, 'checkJadwal']);
    Route::get('/get-pegawaiUpdate', [JadwalController::class, 'checkJadwalUpdate']);
    Route::get('/get-pegawaiDinas', [JadwalController::class, 'checkJadwalDinas']);
    Route::get('/get-pegawaiDinasUpdate', [JadwalController::class, 'checkJadwalDinasUpdate']);

    //perubahan jadwal
    Route::get('ubah-jadwal-{jadwal:id}', [RubahJadwalController::class, 'show']);
    Route::patch('tolak-jadwal/{id}', [RubahJadwalController::class, 'tolakJadwal']);
});

// login
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);

// register
// Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
// Route::post('/register', [RegisterController::class, 'store']);
