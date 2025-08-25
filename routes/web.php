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

//  =========================
//  |  login & auth breeze  |
//  =========================
require __DIR__ . '/auth.php';
Route::get('/', function () {
    return redirect('login');
});


//  =========================
//  |   breeeze dashboard   |
//  =========================
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


//  =========================
//  |     user profile      |
//  =========================
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
            /** ouput var list
             *   index  => $data , $page_count
             */
            Route::get('/account', 'index')->name('index.account');
            Route::get('/account/create', 'create')->name('create.account');
            Route::post('/account/store', 'store')->name('account.store');
        });
        Route::controller(LocketController::class)->group(function () {
            /** ouput var list
             *   index  => $data
             *   create => $services_list
             */
            Route::get('/locket', 'index')->name('admin.locket.index');
            Route::get('locket/create', 'create')->name('admin.locket.create');
            Route::post('locket/store', 'store')->name('admin.locket.store');
        });
        Route::controller(ServicesController::class)->group(function () {
            /** output var list
             *   index => $data
             */
            Route::get('/services', 'index')->name('services.index');
            Route::get('/services/create', 'create')->name('services.create');
            Route::get('/services/store', 'store')->name('services.store');
        });
        Route::controller(RunningTextController::class)->group(function () {
            /** output var list
             *   index => $data (isinya cuman column texts)
             */
            Route::get('/running_text', 'index')->name('runningtext.index');
            Route::post('/running_text/store', 'store')->name('running_text.store');
        });
        Route::controller(VideoController::class)->group(function () {
            /** output var lsit
             *   index => $video
             *          catatan : video->fil_path tidak perlu di panggil dengan asset
             */
            Route::get('/video', 'index')->name('video.index');
            Route::post('/video/store')->name('video.store');
        });
    });
});


//  =========================
//  |       Lockets         |
//  =========================
Route::middleware(['auth', 'role:loket'])->group(function () {
    Route::controller(LocketsController::class)->group(function () {
        Route::get('/lockets', 'index')->name('lockets.index');
    });
});


//  =========================
//  |       Kiosk          |
//  =========================
Route::controller(KioskController::class)->group(function () {
    Route::get('/kiosk', 'index')->name('kiosk.index');
});


//  =========================
//  |       Signage         |
//  =========================
Route::controller(SignageController::class)->group(function () {
    Route::get('/signage', 'index')->name('signage.index');
});


//  =========================
//  |  video custom route   |
//  =========================
Route::get('/video/{filename}', [VideoController::class, 'SignageController@show']);



Route::get('form', function() {
    return view('undefined');
}
)
;
