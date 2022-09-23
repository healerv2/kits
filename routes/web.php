<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Apps\{
    DashboardController,
    UsersController,
    AngkatanController,
    SettingsController,
    KategoriController,
    TutorialController,
    KITSPeduliController,
    DependantDropdownController,
    ActivityLogController,
    KegiatanController,
    ChangePasswordController,
    PengeluaranController,
    LaporanController,
    KandidatController,
    VotingController,
    KITSDuitkuController,
    KITSDuitkuCallbackController,
};

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
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return Inertia::render('Dashboard');
//     })->name('dashboard');
// });

Route::get('/', function () {
    return redirect()->route('login');
});
Route::group(['middleware' => 'auth','verified'], function () {
    //dashboad
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    //Wilayan Indonesia
    // Route::get('provinces', [DependantDropdownController::class, 'provinces'])->name('provinces');
    // Route::get('cities', [DependantDropdownController::class, 'cities'])->name('cities');
    // Route::get('districts', [DependantDropdownController::class, 'districts'])->name('districts');
    // Route::get('villages', [DependantDropdownController::class, 'villages'])->name('villages');

    Route::group(['middleware' => 'level:1,2,3,4'], function () {
         //Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
       Route::get('/log/data', [ActivityLogController::class, 'data'])->name('log.data');
       Route::resource('/log', ActivityLogController::class);
         //User
       Route::get('/users/data', [UsersController::class, 'data'])->name('users.data');
       Route::get('/users/detail/{id}', [UsersController::class, 'detail'])->name('users.detail');
       // Route::get('/users/alumni', [UsersController::class, 'alumni'])->name('users.alumni');
       // Route::get('/alumni/data', [UsersController::class, 'data_alumni'])->name('alumni.data');
       Route::resource('/users', UsersController::class);
         //Angkatan
       Route::get('/angkatan/data', [AngkatanController::class, 'data'])->name('angkatan.data');
       Route::resource('/angkatan', AngkatanController::class);
         //KITS Peduli
       Route::get('/kits-peduli/list', [KITSPeduliController::class, 'list'])->name('kits-peduli.list');
       Route::get('/kits-peduli/data', [KITSPeduliController::class, 'data'])->name('kits-peduli.data');
       Route::get('/kits-peduli/terima-kasih', [KITSPeduliController::class, 'thx'])->name('kits-peduli.terima-kasih');
       Route::resource('/kits-peduli', KITSPeduliController::class);
         //Kategori
       Route::get('/kategori/data', [KategoriController::class, 'data'])->name('kategori.data');
       Route::resource('/kategori', KategoriController::class);
         //Materi
       Route::get('/tutorials/data', [TutorialController::class, 'data'])->name('tutorials.data');
       Route::get('/tutorials/detail/{id}', [TutorialController::class, 'detail'])->name('tutorials.detail');
       Route::post('/tutorials/status', [TutorialController::class, 'updatestatus'])->name('tutorials.status');
       Route::resource('/tutorials', TutorialController::class);
         //Kegiatan
       Route::get('/kegiatans/list', [KegiatanController::class, 'list'])->name('kegiatans.list');
       Route::get('/kegiatans/search', [KegiatanController::class, 'search'])->name('kegiatans.search');
       Route::get('/kegiatans/data', [KegiatanController::class, 'data'])->name('kegiatans.data');
       Route::get('/kegiatans/detail/{slug}', [KegiatanController::class, 'detail'])->name('kegiatans.detail');
       // Route::post('/tutorials/status', [TutorialController::class, 'updatestatus'])->name('tutorials.status');
       Route::resource('/kegiatans', KegiatanController::class);
         //Settings
       Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
       Route::get('/settings/first', [SettingsController::class, 'show'])->name('settings.show');
       Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
       //Laporan
       Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
       Route::get('/laporan/data/{awal}/{akhir}', [LaporanController::class, 'data'])->name('laporan.data');
       //voting
       Route::get('/voting', [VotingController::class, 'pilihan'])->name('voting.pilihan');
       Route::get('/voting/pdf', [VotingController::class, 'pdf'])->name('voting.pdf');
       Route::get('/voter', [VotingController::class, 'list_voter'])->name('list.pemilih');
       Route::get('/voter/data', [VotingController::class, 'data'])->name('voter.data');
       Route::get('/summary', [VotingController::class, 'hasil'])->name('voting.summary');
       Route::put('/users/{id}/pilih', [VotingController::class, 'vote'])->name('users.vote');
       //kits peduli by duitku
       Route::get('/kits-berbagi', [KITSDuitkuController::class, 'index'])->name('kits-berbagi.index');
       Route::post('/kits-berbagi/payment', [KITSDuitkuController::class, 'postPayment'])->name('kits-berbagi.payment');
       Route::post('/kits-berbagi/paymentMethod', [KITSDuitkuController::class, 'postPaymentMethod'])->name('kits-berbagi.postpayment');
   });
    Route::group(['middleware' => 'level:1,2,3,4'], function () {
        Route::get('/profil', [UsersController::class, 'profil'])->name('users.profil');
        Route::post('/profil', [UsersController::class, 'updateprofil'])->name('users.update_profil');
        Route::post('/change-password', [ChangePasswordController::class, 'store'])->name('users.change-password');
    });

    Route::group(['middleware' => 'level:1,2'], function () {
       //pengeluaran
        Route::get('/pengeluaran/data', [PengeluaranController::class, 'data'])->name('pengeluaran.data');
        Route::resource('/pengeluaran', PengeluaranController::class);
        //kandidat
        Route::get('/candidate/data', [KandidatController::class, 'data'])->name('candidate.data');
        Route::get('/candidate/detail/{id}', [KandidatController::class, 'detail'])->name('candidate.detail');
        Route::resource('/candidate', KandidatController::class);
    });
});

Route::post('/callback/payment', [KITSDuitkuCallbackController::class, 'paymentCallback'])->name('callback.payment');
Route::get('/callback/return', [KITSDuitkuCallbackController::class, 'myReturnCallback'])->name('callback.return');