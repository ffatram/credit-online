<?php

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
