<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/guru', [App\Http\Controllers\Admin\GuruController::class, 'index'])->name('admin.guru.index');
    Route::post('/guru/store', [App\Http\Controllers\Admin\GuruController::class, 'store'])->name('admin.guru.store');
    Route::put('/guru/update/{guru}', [App\Http\Controllers\Admin\GuruController::class, 'update'])->name('admin.guru.update');
    Route::delete('/guru/destroy/{guru}', [App\Http\Controllers\Admin\GuruController::class, 'destroy'])->name('admin.guru.destroy');

    Route::get('/siswa', [App\Http\Controllers\Admin\SiswaController::class, 'index'])->name('admin.siswa.index');
    Route::post('/siswa/store', [App\Http\Controllers\Admin\SiswaController::class, 'store'])->name('admin.siswa.store');
    Route::put('/siswa/update/{siswa}', [App\Http\Controllers\Admin\SiswaController::class, 'update'])->name('admin.siswa.update');
    Route::delete('/siswa/destroy/{siswa}', [App\Http\Controllers\Admin\SiswaController::class, 'destroy'])->name('admin.siswa.destroy');

    Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('admin.users.create');
    Route::get('/users/{user}/edit-password', [App\Http\Controllers\Admin\UserController::class, 'editPassword'])->name('admin.users.edit-password');
    Route::get('/users/{user}/edit-role', [App\Http\Controllers\Admin\UserController::class, 'editRole'])->name('admin.users.edit-role');
    Route::post('/users', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('admin.users.store');
    Route::put('/users/{user}/update-password', [App\Http\Controllers\Admin\UserController::class, 'updatePassword'])->name('admin.users.update-password');
    Route::put('/users/{user}/update-role', [App\Http\Controllers\Admin\UserController::class, 'updateRole'])->name('admin.users.update-role');
    Route::delete('/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('admin.users.destroy');

    Route::get('/komponen', [App\Http\Controllers\Admin\KomponenController::class, 'index'])->name('admin.komponen.index');
    Route::post('/komponen/store', [App\Http\Controllers\Admin\KomponenController::class, 'store'])->name('admin.komponen.store');
    Route::put('/komponen/update/{komponen}', [App\Http\Controllers\Admin\KomponenController::class, 'update'])->name('admin.komponen.update');
    Route::delete('/komponen/destroy/{komponen}', [App\Http\Controllers\Admin\KomponenController::class, 'destroy'])->name('admin.komponen.destroy');

    Route::get('/atribut', [App\Http\Controllers\Admin\AtributController::class, 'index'])->name('admin.atribut.index');
    Route::post('/atribut/store', [App\Http\Controllers\Admin\AtributController::class, 'store'])->name('admin.atribut.store');
    Route::put('/atribut/update/{atribut}', [App\Http\Controllers\Admin\AtributController::class, 'update'])->name('admin.atribut.update');
    Route::delete('/atribut/destroy/{atribut}', [App\Http\Controllers\Admin\AtributController::class, 'destroy'])->name('admin.atribut.destroy');

    Route::get('/pengumuman', [App\Http\Controllers\Admin\PengumumanController::class, 'index'])->name('admin.pengumuman.index');
    Route::post('/pengumuman/store', [App\Http\Controllers\Admin\PengumumanController::class, 'store'])->name('admin.pengumuman.store');
    Route::put('/pengumuman/update/{pengumuman}', [App\Http\Controllers\Admin\PengumumanController::class, 'update'])->name('admin.pengumuman.update');
    Route::delete('/pengumuman/destroy/{pengumuman}', [App\Http\Controllers\Admin\PengumumanController::class, 'destroy'])->name('admin.pengumuman.destroy');

    Route::get('/kategori-pengaduan', [App\Http\Controllers\Admin\KategoriPengaduanController::class, 'index'])->name('admin.kategori-pengaduan.index');
    Route::post('/kategori-pengaduan/store', [App\Http\Controllers\Admin\KategoriPengaduanController::class, 'store'])->name('admin.kategori-pengaduan.store');
    Route::put('/kategori-pengaduan/update/{kategoriPengaduan}', [App\Http\Controllers\Admin\KategoriPengaduanController::class, 'update'])->name('admin.kategori-pengaduan.update');
    Route::delete('/kategori-pengaduan/destroy/{kategoriPengaduan}', [App\Http\Controllers\Admin\KategoriPengaduanController::class, 'destroy'])->name('admin.kategori-pengaduan.destroy');

    Route::get('/pengaduan', [App\Http\Controllers\Admin\PengaduanController::class, 'index'])->name('admin.pengaduan.index');
    Route::get('/pengaduan/create', [App\Http\Controllers\Admin\PengaduanController::class, 'create'])->name('admin.pengaduan.create');
    Route::post('/pengaduan/store', [App\Http\Controllers\Admin\PengaduanController::class, 'store'])->name('admin.pengaduan.store');
    Route::put('/pengaduan/{pengaduan}/update', [App\Http\Controllers\Admin\PengaduanController::class, 'update'])->name('admin.pengaduan.update');
    Route::delete('/pengaduan/destroy/{pengaduan}', [App\Http\Controllers\Admin\PengaduanController::class, 'destroy'])->name('admin.pengaduan.destroy');

    Route::get('/kekerasan', [App\Http\Controllers\Admin\KekerasanController::class, 'index'])->name('admin.kekerasan.index');
    Route::get('/kekerasan/{kekerasan}/edit', [App\Http\Controllers\Admin\KekerasanController::class, 'edit'])->name('admin.kekerasan.edit');
    Route::post('/kekerasan/store', [App\Http\Controllers\Admin\KekerasanController::class, 'store'])->name('admin.kekerasan.store');
    Route::put('/kekerasan/update/{kekerasan}', [App\Http\Controllers\Admin\KekerasanController::class, 'update'])->name('admin.kekerasan.update');
    Route::delete('/kekerasan/destroy/{kekerasan}', [App\Http\Controllers\Admin\KekerasanController::class, 'destroy'])->name('admin.kekerasan.destroy');


    Route::get("ajax-request/daftar-siswa-by-kelas/{kelas}", [\App\Http\Controllers\Admin\AjaxController::class, 'daftarSiswaByKelas'])->name('admin.ajax.daftar-siswa-by-kelas');
    Route::get("ajax-request/daftar-atribut-by-komponen/{komponen}", [\App\Http\Controllers\Admin\AjaxController::class, 'daftarAtributByKomponen'])->name('admin.ajax.daftar-atribut-by-komponen');
})->middleware([\App\Http\Middleware\SummaryCountAdminMiddleware::class]);

require __DIR__ . '/auth.php';
