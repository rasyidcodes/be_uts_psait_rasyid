<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\NilaiController;

Route::get('/', function () {
    return view('welcome');
});

 Route::get('/token', function () {
        return csrf_token();
    });


// Menampilkan semua nilai mahasiswa
Route::get('/api/nilai', [NilaiController::class, 'index']);

// Menampilkan nilai mahasiswa tertentu berdasarkan NIM
Route::get('/api/nilai/{nim}', [NilaiController::class, 'show']);

// Memasukkan nilai baru untuk mahasiswa tertentu
Route::post('/api/nilai', [NilaiController::class, 'store']);

// Mengupdate nilai berdasarkan NIM dan kode_mk
Route::put('/api/nilai/{nim}/{kode_mk}', [NilaiController::class, 'update']);

// Menghapus nilai berdasarkan NIM dan kode_mk
Route::delete('/api/nilai/{nim}/{kode_mk}', [NilaiController::class, 'destroy']);
