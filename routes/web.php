<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\UserSettingsController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\BukuController;
use App\Http\Controllers\Admin\TempatBukuController;
use App\Http\Controllers\Admin\RekapanPeminjamanController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PeminjamanController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::middleware('revalidate')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::controller(LoginController::class)->group(function () {
            Route::get('/login', 'login')->name('login');
            Route::post('/authenticate', 'authenticate')->name('authenticate');
        });
        Route::controller(RegisterController::class)->group(function () {
            Route::get('/register', 'register')->name('register');
            Route::post('/registration', 'registration')->name('registration');
        });
        Route::controller(ForgotPasswordController::class)->group(function () {
            Route::get('/forgot-password', 'forgotPassword')->name('forgotPassword');
            Route::post('/forgotPasswordProcess', 'forgotPasswordProses')->name('forgotPasswordProses');
        });
        Route::controller(ResetPasswordController::class)->group(function () {
            Route::get('/reset-password/{token}', 'resetPassword')->name('resetPassword');
            Route::post('/reset-password', 'resetPasswordProcess')->name('resetPasswordProcess');
        });
    });
    Route::middleware('auth')->group(function () {
        Route::controller(LogoutController::class)->group(function () {
            Route::post('/logout', 'logout')->name('logout');
        });
        Route::name('dashboard.')->group(function () {
            Route::prefix('/dashboard')->group(function () {
                Route::controller(DashboardController::class)->group(function () {
                    Route::get('', 'index')->name('');
                });
                Route::middleware('admin')->group(function () {
                    Route::resource('kategori', KategoriController::class)->except('create');
                    Route::resource('buku', BukuController::class)->except('create', 'show');
                    Route::resource('tempat_buku', TempatBukuController::class)->except('create');
                    Route::controller(PeminjamanController::class)->group(function () {
                        Route::get('/pinjam/pending', 'pending')->name('peminjaman.pending');
                        Route::get('/pinjam/ditolak', 'ditolak')->name('peminjaman.ditolak');
                        Route::get('/pinjam/berlangsung', 'berlangsung')->name('peminjaman.berlangsung');
                        Route::patch('/pinjam/konfirmasi', 'update')->name('peminjaman.persetujuan');
                        Route::post('/pinjam/selesai/{id}', 'selesai')->name('peminjaman.selesai');
                        Route::delete('/pinjam/hapus/{id}', 'destroy')->name('peminjaman.hapus');
                    });
                    Route::controller(RekapanPeminjamanController::class)->group(function () {
                        Route::get('/rekapan', 'index')->name('rekapan.index');
                        Route::post('/rekapan/print', 'print')->name('rekapan.print');
                    });
                });
            });
        });
        Route::controller(UserSettingsController::class)->group(function () {
            Route::prefix('dashboard/user')->group(function () {
                Route::name('dashboard.user.')->group(function () {
                    Route::get('/settings', 'index')->name('settings');
                });
            });
        });
        Route::middleware('user')->group(function () {
            Route::controller(PeminjamanController::class)->group(function () {
                Route::post('/pinjam/store', 'store')->name('pinjam.store');
            });
        });
    });
    Route::controller(LandingPageController::class)->group(function () {
        Route::get('/', 'index')->name('landing');
    });
});
