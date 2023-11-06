<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/absensi-index', [WelcomeController::class, 'absensiIndex'])->name('guest.absensi.index');
Route::get('/pengaduan-index', [WelcomeController::class, 'pengaduanIndex'])->name('guest.pengaduan.index');
Route::get('/pengaduan-create', [WelcomeController::class, 'pengaduanCreate'])->name('guest.pengaduan.create');
Route::post('/pengaduan-store', [WelcomeController::class, 'pengaduanStore'])->name('guest.pengaduan.store');
Route::get('/pengumuman-index', [WelcomeController::class, 'pengumumanIndex'])->name('guest.pengumuman.index');
Route::get('/kekerasan-index', [WelcomeController::class, 'kekerasanIndex'])->name('guest.kekerasan.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('app')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\App\DashboardController::class, 'index'])->name('app.dashboard');

    Route::middleware(['role:OPERATOR_SEKOLAH'])->group(function () {
        Route::get('/guru', [App\Http\Controllers\App\GuruController::class, 'index'])->name('app.guru.index')->middleware([]);
        Route::post('/guru/store', [App\Http\Controllers\App\GuruController::class, 'store'])->name('app.guru.store');
        Route::put('/guru/update/{guru}', [App\Http\Controllers\App\GuruController::class, 'update'])->name('app.guru.update');
        Route::delete('/guru/destroy/{guru}', [App\Http\Controllers\App\GuruController::class, 'destroy'])->name('app.guru.destroy');

        Route::get('/siswa', [App\Http\Controllers\App\SiswaController::class, 'index'])->name('app.siswa.index');
        Route::post('/siswa/store', [App\Http\Controllers\App\SiswaController::class, 'store'])->name('app.siswa.store');
        Route::put('/siswa/update/{siswa}', [App\Http\Controllers\App\SiswaController::class, 'update'])->name('app.siswa.update');
        Route::delete('/siswa/destroy/{siswa}', [App\Http\Controllers\App\SiswaController::class, 'destroy'])->name('app.siswa.destroy');

        Route::get('/users', [App\Http\Controllers\App\UserController::class, 'index'])->name('app.users.index');
        Route::get('/users/create', [App\Http\Controllers\App\UserController::class, 'create'])->name('app.users.create');
        Route::get('/users/{user}/edit-password', [App\Http\Controllers\App\UserController::class, 'editPassword'])->name('app.users.edit-password');
        Route::get('/users/{user}/edit-role', [App\Http\Controllers\App\UserController::class, 'editRole'])->name('app.users.edit-role');
        Route::post('/users', [App\Http\Controllers\App\UserController::class, 'store'])->name('app.users.store');
        Route::put('/users/{user}/update-password', [App\Http\Controllers\App\UserController::class, 'updatePassword'])->name('app.users.update-password');
        Route::put('/users/{user}/update-role', [App\Http\Controllers\App\UserController::class, 'updateRole'])->name('app.users.update-role');
        Route::delete('/users/{user}', [App\Http\Controllers\App\UserController::class, 'destroy'])->name('app.users.destroy');

        Route::get('/komponen', [App\Http\Controllers\App\KomponenController::class, 'index'])->name('app.komponen.index');
        Route::post('/komponen/store', [App\Http\Controllers\App\KomponenController::class, 'store'])->name('app.komponen.store');
        Route::put('/komponen/update/{komponen}', [App\Http\Controllers\App\KomponenController::class, 'update'])->name('app.komponen.update');
        Route::delete('/komponen/destroy/{komponen}', [App\Http\Controllers\App\KomponenController::class, 'destroy'])->name('app.komponen.destroy');

        Route::get('/atribut', [App\Http\Controllers\App\AtributController::class, 'index'])->name('app.atribut.index');
        Route::post('/atribut/store', [App\Http\Controllers\App\AtributController::class, 'store'])->name('app.atribut.store');
        Route::put('/atribut/update/{atribut}', [App\Http\Controllers\App\AtributController::class, 'update'])->name('app.atribut.update');
        Route::delete('/atribut/destroy/{atribut}', [App\Http\Controllers\App\AtributController::class, 'destroy'])->name('app.atribut.destroy');

        Route::get('/pengumuman', [App\Http\Controllers\App\PengumumanController::class, 'index'])->name('app.pengumuman.index');
        Route::post('/pengumuman/store', [App\Http\Controllers\App\PengumumanController::class, 'store'])->name('app.pengumuman.store');
        Route::put('/pengumuman/update/{pengumuman}', [App\Http\Controllers\App\PengumumanController::class, 'update'])->name('app.pengumuman.update');
        Route::delete('/pengumuman/destroy/{pengumuman}', [App\Http\Controllers\App\PengumumanController::class, 'destroy'])->name('app.pengumuman.destroy');

        Route::get('/kategori-pengaduan', [App\Http\Controllers\App\KategoriPengaduanController::class, 'index'])->name('app.kategori-pengaduan.index');
        Route::post('/kategori-pengaduan/store', [App\Http\Controllers\App\KategoriPengaduanController::class, 'store'])->name('app.kategori-pengaduan.store');
        Route::put('/kategori-pengaduan/update/{kategoriPengaduan}', [App\Http\Controllers\App\KategoriPengaduanController::class, 'update'])->name('app.kategori-pengaduan.update');
        Route::delete('/kategori-pengaduan/destroy/{kategoriPengaduan}', [App\Http\Controllers\App\KategoriPengaduanController::class, 'destroy'])->name('app.kategori-pengaduan.destroy');
    });

    Route::get('/pengaduan', [App\Http\Controllers\App\PengaduanController::class, 'index'])->name('app.pengaduan.index');
    Route::get('/pengaduan/create', [App\Http\Controllers\App\PengaduanController::class, 'create'])->name('app.pengaduan.create');
    Route::post('/pengaduan/store', [App\Http\Controllers\App\PengaduanController::class, 'store'])->name('app.pengaduan.store');
    Route::put('/pengaduan/{pengaduan}/update', [App\Http\Controllers\App\PengaduanController::class, 'update'])->name('app.pengaduan.update');
    Route::delete('/pengaduan/destroy/{pengaduan}', [App\Http\Controllers\App\PengaduanController::class, 'destroy'])->name('app.pengaduan.destroy');

    // modul kekerasan
    Route::get('/kekerasan', [App\Http\Controllers\App\KekerasanController::class, 'index'])->name('app.kekerasan.index');
    Route::get('/kekerasan/{kekerasan}/edit', [App\Http\Controllers\App\KekerasanController::class, 'edit'])->name('app.kekerasan.edit')->middleware(['role:OPERATOR_SEKOLAH|GURU_BK']);
    Route::post('/kekerasan/store', [App\Http\Controllers\App\KekerasanController::class, 'store'])->name('app.kekerasan.store')->middleware(['role:OPERATOR_SEKOLAH|GURU_BK']);
    Route::put('/kekerasan/update/{kekerasan}', [App\Http\Controllers\App\KekerasanController::class, 'update'])->name('app.kekerasan.update')->middleware(['role:OPERATOR_SEKOLAH|GURU_BK']);
    Route::delete('/kekerasan/destroy/{kekerasan}', [App\Http\Controllers\App\KekerasanController::class, 'destroy'])->name('app.kekerasan.destroy')->middleware(['role:OPERATOR_SEKOLAH|GURU_BK']);

    // data absensi
    Route::get("/absensi", [\App\Http\Controllers\App\AbsensiController::class, 'index'])->name('app.absensi.index');
    Route::get("/absensi/create", [\App\Http\Controllers\App\AbsensiController::class, 'create'])->name('app.absensi.create');
    Route::post("/absensi/store", [\App\Http\Controllers\App\AbsensiController::class, 'store'])->name('app.absensi.store');
    Route::put("/absensi/update", [\App\Http\Controllers\App\AbsensiController::class, 'update'])->name('app.absensi.update');
})->middleware([\App\Http\Middleware\SummaryCountAppMiddleware::class]);


Route::get("ajax-request/daftar-siswa-by-kelas/{kelas}", [\App\Http\Controllers\App\AjaxController::class, 'daftarSiswaByKelas'])->name('app.ajax.daftar-siswa-by-kelas');
Route::get("ajax-request/daftar-atribut-by-komponen/{komponen}", [\App\Http\Controllers\App\AjaxController::class, 'daftarAtributByKomponen'])->name('app.ajax.daftar-atribut-by-komponen');


require __DIR__ . '/auth.php';
