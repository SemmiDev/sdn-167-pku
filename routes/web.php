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

Route::prefix('admin')->middleware(['auth', 'role:OPERATOR_SEKOLAH'])->group(function () {
    Route::get('/guru', [App\Http\Controllers\Admin\GuruController::class, 'index'])->name('admin.guru.index');
    Route::post('/guru/store', [App\Http\Controllers\Admin\GuruController::class, 'store'])->name('admin.guru.store');
    Route::put('/guru/update/{guru}', [App\Http\Controllers\Admin\GuruController::class, 'update'])->name('admin.guru.update');
    Route::delete('/guru/destroy/{guru}', [App\Http\Controllers\Admin\GuruController::class, 'destroy'])->name('admin.guru.destroy');

//    Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
//    Route::get('/users/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('admin.users.create');
//    Route::post('/users', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('admin.users.store');
})->middleware([\App\Http\Middleware\SummaryCountAdminMiddleware::class]);

require __DIR__ . '/auth.php';
