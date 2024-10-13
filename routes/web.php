<?php

use App\Http\Controllers\Trangchu\FunctionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrangChu\TrangChuController;

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


Route::get('/', [TrangChuController::class, 'trangchu'])->name('trangchu');
Route::get('/upload', [TrangChuController::class, 'upload'])->name('upload');
Route::get('/realtime', [TrangChuController::class, 'realtime'])->name('realtime');

Route::post('/save-database', [FunctionController::class, 'addCCCD'])->name('addCCCD');
Route::post('/export-to-word', [FunctionController::class, 'exportToWord'])->name('exportToWord');
Route::post('/export-to-excel', [FunctionController::class, 'exportToExcel'])->name('exportToExcel');
Route::post('/export-to-pdf', [FunctionController::class, 'exportToPDF'])->name('exportToPDF');




