<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/import', [ProductController::class,'import'])->name('import-product');
Route::post('/import-csv', [ProductController::class, 'importCSV'])->name('import.csv');

Route::get('/export', [ProductController::class,'export'])->name('export-product');
Route::get('/export-csv', [ProductController::class, 'exportCSV'])->name('export.csv');