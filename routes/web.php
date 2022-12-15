<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportFileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('import', [ImportFileController::class, 'importFile']);
Route::post('import_parse', [ImportFileController::class, 'importParse'])->name('import_parse');
Route::post('import_process', [ImportFileController::class, 'importProcess'])->name('import_process');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
