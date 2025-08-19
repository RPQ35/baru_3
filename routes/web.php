<?php

use App\Http\Controllers\admin\AccountController;
use App\Http\Controllers\admin\LocketController;
use App\Http\Controllers\admin\RunningTextController;
use App\Http\Controllers\admin\ServicesController;
use App\Http\Controllers\admin\VideoController;
use App\Http\Controllers\Kiosk\KioskController;
use App\Http\Controllers\Locket\LocketsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Signage\SignageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



//  =========================
//  |       Admin           |
//  =========================
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::controller(AccountController::class)->group(function () {

        });
        Route::controller(LocketController::class)->group(function () {

        });
        Route::controller(ServicesController::class)->group(function () {

        });
        Route::controller(RunningTextController::class)->group(function () {

        });
        Route::controller(VideoController::class)->group(function () {

        });
    });
});

//  =========================
//  |       Locket          |
//  =========================
Route::middleware(['auth', 'role:loket'])->group(function () {
    Route::controller(LocketsController::class)->group(function () {

    });
});


//  =========================
//  |       Kiosk          |
//  =========================
Route::controller(KioskController::class)->group(function () {
    Route::get('/kiosk', 'index');
});

//  =========================
//  |       Signage         |
//  =========================
Route::controller(SignageController::class)->group(function () {
    Route::get('/signage', 'index');
});


require __DIR__ . '/auth.php';
