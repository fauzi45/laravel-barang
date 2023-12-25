<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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


//No. 1
Route::get('/form', [FormController::class, 'showForm']);
Route::post('/process-form', [FormController::class, 'processForm'])->name('process.form');

//No. 2
Route::get('/generate-codes', [FormController::class, 'generateCodes']);
Route::get('/codes', [FormController::class, 'index'])->name('codes.index');
Route::get('/codes/{date}/detail', [FormController::class, 'showDetail']);

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/barang', BarangController::class);
});
