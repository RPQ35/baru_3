<?php

use App\Http\Controllers\admin\AccountController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\LocketController;
use App\Http\Controllers\admin\RunningTextController;
use App\Http\Controllers\admin\ServicesController;
use App\Http\Controllers\admin\VideoController;
use App\Http\Controllers\ConfigurationController;
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
//  |   breeeze dashboar                                                                                                                                                                                                                                                                      d   |
//  =========================
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


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
            Route::post('/account/update', 'update')->name('account.update');
            Route::delete('/account/{id}', 'destroy')->name('account.destroy');
        });
        Route::controller(LocketController::class)->group(function () {
            /** ouput var list
             *   index  => $data
             *   create => $services_list
             */
            Route::get('/locket', 'index')->name('admin.locket.index');
            Route::get('locket/create', 'create')->name('admin.locket.create');
            Route::post('locket/store', 'store')->name('admin.locket.store');
            Route::delete('locket/destroy/{id}', 'destroy')->name('admin.destroy.locket');
            Route::post('locket/update', 'update')->name('admin.locket.update');
        });
        Route::controller(ServicesController::class)->group(function () {
            /** output var list
             *   index => $data
             */
            Route::get('/services', 'index')->name('services.index');
            Route::get('/services/create', 'create')->name('services.create');
            Route::post('/services/store', 'store')->name('services.store');
            Route::post('/services/logo', 'temp_logo');
            Route::post('/services/update', 'update')->name('services.update');
            Route::delete('/services/{id}', 'destroy')->name('services.destroy');
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
             *          catatan : video->file_path tidak perlu di panggil dengan asset
             */
            Route::get('/video', 'index')->name('video.index');
            Route::get('/video/create', function () {
                return view('admin.video.new-vdeo');
            });
            Route::post('/video/status', 'status');
            Route::post('/video/update', 'update')->name('video.update');
            Route::post('/video/upload', 'create'); //store temporary file
            Route::get('/video/temp/{files}', 'edit'); //get temporary file for display
            Route::post('/video/store', 'store')->name('video.store');
        });
        Route::controller(ConfigurationController::class)->group(function () {
            Route::get('/config', 'index')->name('config');
            Route::post('/config/swicth', 'update');
        });
    });
});


//  =========================
//  |       Lockets         |
//  =========================
Route::middleware(['auth', 'role:loket'])->group(function () {
    Route::controller(LocketsController::class)->group(function () {
        Route::get('/lockets/select', 'index')->name('lockets.index');
        Route::post('/lockets', 'show')->name('lockets.main');
        Route::get('/lockets/app', 'edit')->name('locket.app');
        Route::post('/lockets/app/oncoming', 'oncoming');
        Route::post('/lockets/app/active', 'active')->name('locket.active');
        Route::post('/lockets/app/status', 'status')->name('locket.status');
    });
});


//  =========================
//  |       Kiosk          |
//  =========================
Route::controller(KioskController::class)->group(function () {
    Route::get('/kiosk', 'index')->name('kiosk.index');
    Route::post('/kiosk/take-number', [KioskController::class, 'takeNumber'])->name('kiosk.takeNumber');
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
Route::get('/video/{filename}', [VideoController::class, 'show']);



Route::get(
    'form',
    function () {
        return view('undefined');
    }
);
