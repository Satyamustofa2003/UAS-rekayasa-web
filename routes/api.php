<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MakulController;

/*
|---------------------------------------------------------------------------
| API Routes
|---------------------------------------------------------------------------
|
| Here is where you can register API routes for your application.
| These routes are loaded by the RouteServiceProvider within a group
| which is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Register route
Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);

// Login route
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

// Route for authenticated user (user information)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Group of routes that require authentication
Route::middleware('auth:sanctum')->group(function () {
    // Logout route
    Route::post('/logout', [\App\Http\Api\AuthController::class, 'logout']);
});

Route::prefix('mahasiswa')->group(function () {
    // Menambahkan mahasiswa baru (create)
    Route::post('create', [MahasiswaController::class, 'create']); 

    // Menampilkan semua mahasiswa (read)
    Route::get('read', [MahasiswaController::class, 'read']); 

    // Menampilkan mahasiswa berdasarkan ID (read)
    Route::get('show/{id}', [MahasiswaController::class, 'show']); 

    // Mengupdate mahasiswa berdasarkan ID (update)
    Route::put('update/{id}', [MahasiswaController::class, 'update']); 

    // Menghapus mahasiswa berdasarkan ID (delete)
    Route::delete('delete/{id}', [MahasiswaController::class, 'delete']); 
});


Route::prefix('dosen')->group(function () {
    Route::post('create', [DosenController::class, 'create']); // Menambahkan dosen baru
    Route::get('read', [DosenController::class, 'read']); // Menampilkan semua dosen
    Route::put('update', [DosenController::class, 'update']); // Mengupdate dosen berdasarkan ID
    Route::delete('delete', [DosenController::class, 'delete']); // Menghapus dosen berdasarkan ID
});

Route::prefix('makul')->group(function () {
    Route::post('create', [MakulController::class, 'create']); // Menambahkan mata kuliah baru
    Route::get('read', [MakulController::class, 'read']); // Menampilkan semua mata kuliah
    Route::put('makul/update', [MakulController::class, 'update']); // Mengupdate mata kuliah berdasarkan ID
    Route::delete('delete', [MakulController::class, 'delete']); // Menghapus mata kuliah berdasarkan ID
});

