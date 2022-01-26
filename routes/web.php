<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MagangController;
use App\Http\Controllers\NotifController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\KPController;
use App\Http\Controllers\ProgressKPController;

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

route::get('/', function(){return redirect('/login');});
route::get('/home', function(){return view('home');})->name('home');

route::get('/login', [AuthController::class, 'halamanlogin']);
route::post('/login', [AuthController::class, 'login'])->name('login');

route::get('/gantipass', [AuthController::class, 'halamangp']);
route::post('/gantipass', [AuthController::class, 'ganti_pass']);

route::get('/signout', [AuthController::class, 'signOut'])->name('signout');

// route::group(['middleware' => ['auth', 'ceklevel:admin']], function() {
// });
// route::group(['middleware' => ['auth', 'ceklevel:mahasiswa, admin, dosen']], function() {
// });

route::get('/magang', [MagangController::class, 'tampil'])->name('halaman_magang');
route::post('/magang', [MagangController::class, 'tambah']);
route::delete('/magang/delete/{no_magang}', [MagangController::class, 'hapus']);
route::get('/magang/edit/{no_magang}', [MagangController::class, 'ubah']);
route::post('/magang/update/{no_magang}', [MagangController::class, 'update']);
route::post('/magang/status/{no_magang}', [MagangController::class, 'status']);
route::get('/magang/list', [MagangController::class, 'daftar'])->name('daftar_magang');
route::get('/magang/form', [MagangController::class, 'form'])->name('form_magang');
route::post('/magang/laporan/{no_kp}', [MagangController::class, 'upload']);
route::post('/magang/laporan_unduh/{file}', [MagangController::class, 'unduh']);
route::get('/magang/unduhdatamagang', [MagangController::class, 'unduhdatamagang']);

route::get('/kp', [KPController::class, 'tampil'])->name('halaman_kp');
route::post('/kp', [KPController::class, 'tambah']);
route::delete('/kp/delete/{no_kp}', [KPController::class, 'hapus']);
route::get('/kp/edit/{no_kp}', [KPController::class, 'ubah']);
route::post('/kp/update/{no_kp}', [KPController::class, 'update']);
route::post('/kp/status/{no_kp}', [KPController::class, 'status']);
route::get('/kp/dospem/{no_kp}', [KPController::class, 'saran']);
route::post('/kp/dospem/{no_kp}', [KPController::class, 'dospem']);
route::get('/kp/semhas/{no_kp}', [KPController::class, 'semhas']);
route::post('/kp/semhas/{no_kp}', [KPController::class, 'update_semhas']);
route::get('/kp/list', [KPController::class, 'daftar'])->name('daftar_kp');
route::get('/kp/form', [KPController::class, 'form'])->name('form_kp');
route::post('/kp/laporan/{no_kp}', [KPController::class, 'upload']);
route::post('/kp/laporan_unduh/{file}', [KPController::class, 'unduh']);
route::get('/kp/print', [KPController::class, 'print']);
route::get('/kp/unduhdatakp', [KPController::class, 'unduhdatakp']);

route::get('/progress_kp/{no_kp}', [ProgressKPController::class, 'tampil'])->name('halaman_progress_kp');
route::post('/progress_kp/{no_kp}', [ProgressKPController::class, 'tambah']);
route::delete('/progress_kp/delete/{no_progress}/{no_kp}', [ProgressKPController::class, 'hapus'])->name('hapus_progress_kp');
route::get('/progress_kp/edit/{no_progress}/{no_kp}', [ProgressKPController::class, 'ubah'])->name('ubah_progress_kp');
route::post('/progress_kp/update/{no_progress}/{no_kp}', [ProgressKPController::class, 'update'])->name('update_progress_kp');
route::post('/progress_kp/unduh/{file}', [ProgressKPController::class, 'unduh'])->name('unduh_progress_kp');

route::get('/notif', [NotifController::class, 'tampil']);

route::get('/user', [UserController::class, 'tampil'])->name('halaman_user');
route::post('/user', [UserController::class, 'tambah']);
route::delete('/user/delete/{id}', [UserController::class, 'hapus']);
route::get('/user/edit/{id}', [UserController::class, 'ubah']);
route::post('/user/update/{id}', [UserController::class, 'update']);

route::get('/dosen', [DosenController::class, 'tampil'])->name('halaman_dosen');
route::post('/dosen', [DosenController::class, 'tambah']);
route::delete('/dosen/delete/{nama_dosen}', [DosenController::class, 'hapus']);
route::get('/dosen/edit/{nama_dosen}', [DosenController::class, 'ubah']);
route::post('/dosen/update/{nama_dosen}', [DosenController::class, 'update']);

route::get('/mahasiswa', [MahasiswaController::class, 'tampil'])->name('halaman_mahasiswa');
route::post('/mahasiswa', [MahasiswaController::class, 'tambah']);
route::delete('/mahasiswa/delete/{nama_mahasiswa}', [MahasiswaController::class, 'hapus']);
route::get('/mahasiswa/edit/{nama_mahasiswa}', [MahasiswaController::class, 'ubah']);
route::post('/mahasiswa/update/{nama_mahasiswa}', [MahasiswaController::class, 'update']);