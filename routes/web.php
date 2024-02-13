<?php

use App\Http\Controllers\ApiKreditOnlineController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PemohonController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Carbon;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', function () {
//     return view('home');
// });

// Route untuk metode GET dan POST
Route::match(['get', 'post'], '/', [PemohonController::class, 'index'])->name('home');
Route::get('/api-permohonan-cabang/{id}', [ApiKreditOnlineController::class, 'getPermohonanWhereCabang']);
Route::get('/api-permohonan/{id}', [ApiKreditOnlineController::class, 'getPermohonanWhereId']);
Route::get('/api-image/{id}', [ApiKreditOnlineController::class, 'getFile']);
Route::get('/api-file-berkas/{id}', [ApiKreditOnlineController::class, 'fileBerkas']);
Route::get('/api-destroy-data/{id}', [ApiKreditOnlineController::class, 'destroydatafile']);


Route::get('/get-csrf-token', [ApiKreditOnlineController::class, 'getCsrfToken']);



Route::get('/tanggal', function () {

    $now = Carbon::now();

    // Atur zona waktu sesuai dengan zona waktu server
    $now->setTimezone(config('app.timezone'));
    // Formatkan tanggal sesuai dengan kebutuhan Anda
    $formattedDate = $now->format('dmY_His');

    // Tampilkan tanggal yang diformat
    echo $formattedDate;
    // return view('home');
});



Route::get('/alert', [PemohonController::class, 'alert']);
