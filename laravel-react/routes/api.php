<?php

use App\Http\Resources\LotlogResource;
use App\Models\Lotlog;
use App\Http\Controllers\LotlogController;
use App\Http\Controllers\Api\DataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/lotlogs', function(){
    return LotlogResource::collection(Lotlog::all());
});

Route::post('/lotlog', [LotlogController::class, 'store']);

Route::post('/save', [DataController::class, 'postData']);