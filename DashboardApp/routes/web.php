<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UploadController;

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

Route::controller(DashboardController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::post('/', 'index');

});

Route::controller(ReportController::class)->group(function () {
    Route::get('/dataview', 'index')->name('reports');
    Route::get('/dataview/{id}', 'delete');
    Route::post('/dataview', 'add');
});

Route::controller(UploadController::class)->group(function () {
    Route::get('/upload', 'index');
    Route::post('/upload', 'store');
});
