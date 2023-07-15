<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\User\UserSettingsController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\BukuController;
use App\Http\Controllers\Admin\TempatBukuController;
use App\Http\Controllers\Admin\RekapanController;
use App\Http\Controllers\Admin\TahunAjaranController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\KelolaAnggotaController;
use App\Http\Controllers\Admin\DendaController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Admin\KelolaPeminjamanController;
use App\Http\Controllers\User\PeminjamanController;
use App\Http\Controllers\User\RiwayatController;



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
                    Route::resource('tahunAjaran', TahunAjaranController::class)->except('create', 'show', 'destroy');
                    Route::resource('jurusan', JurusanController::class)->except('create', 'show', 'destroy');
                    Route::resource('anggota', KelolaAnggotaController::class)->except('create');
                    Route::controller(KelolaAnggotaController::class)->group(function () {
                        Route::post('/anggota/import', 'import')->name('anggota.import');
                    });
                    Route::resource('denda', DendaController::class)->only('index', 'update', 'store');
                    Route::controller(DendaController::class)->group(function () {
                        Route::post('/denda/bayar', 'bayar')->name('denda.bayar');
                    });
                    Route::resource('tempat_buku', TempatBukuController::class)->except('create');
                    Route::controller(KelolaPeminjamanController::class)->group(function () {
                        Route::get('/peminjaman', 'index')->name('peminjaman.index');
                        Route::get('/peminjaman/{id}', 'show')->name('peminjaman.show');
                        Route::post('/peminjaman/selesai', 'selesai')->name('peminjaman.selesai');
                    });
                    Route::controller(RekapanController::class)->group(function () {
                        Route::get('/rekapan_peminjaman_buku', 'peminjaman_buku')->name('rekapan.peminjaman_buku');
                        Route::get('/riwayat_pembayaran_denda', 'pembayaran_denda')->name('rekapan.pembayaran_denda');
                        Route::post('/print/rekapan_peminjaman_buku', 'print_peminjaman')->name('rekapan.print.peminjaman_buku');
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
            Route::controller(RiwayatController::class)->group(function () {
                Route::get('/riwayat/peminjaman', 'peminjaman')->name('riwayat.peminjaman');
                Route::get('/riwayat/peminjaman_aktif', 'peminjaman_aktif')->name('riwayat.peminjaman_aktif');
                Route::get('/riwayat/pembayaran_denda', 'pembayaran_denda')->name('riwayat.pembayaran_denda');
            });
        });
    });
    Route::controller(LandingPageController::class)->group(function () {
        Route::get('/', 'index')->name('landing');
    });
});
