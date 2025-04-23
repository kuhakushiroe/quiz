<?php

use App\Http\Controllers\Auth\LoginController;
use App\Livewire\Banksoal\Banksoal;
use App\Livewire\Dashboard\Dashboard;
use App\Livewire\Histori\HistoriUjian;
use App\Livewire\Mahasiswa\Mahasiswa;
use App\Livewire\Ocr\Ocr;
use App\Livewire\Ujian\Ujian;
use App\Livewire\Ujian\UjianMahasiswa;
use App\Livewire\Users\User;
use Illuminate\Support\Facades\Route;

Auth::routes([
    'register' => false,
    'forgot' => false
]);
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::get('/home', Dashboard::class)->name('dashboard');
    Route::get('/ocr', Ocr::class)->name('ocr');

    Route::group(['middleware' => ['role:superadmin']], function () {
        Route::get('users', User::class)->name('users');
    });
    Route::group(['middleware' => ['role:dosen,superadmin']], function () {
        Route::get('mahasiswa', Mahasiswa::class)->name('mahasiswa');
        Route::get('bank-soal', Banksoal::class)->name('bank-soal');
        Route::get('ujian-dosen', Ujian::class)->name('ujian-dosen');
    });
    Route::get('ujian-mahasiswa', UjianMahasiswa::class)->name('ujian-mahasiswa');
    Route::group(['middleware' => ['role:dosen,mahasiswa']], function () {
        Route::get('hasil-ujian', HistoriUjian::class)->name('hasil-ujian');
    });

    Route::get('logout', LoginController::class . '@logout')->name('logout');
});
