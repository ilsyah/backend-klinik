<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthDokterController;
use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PelayananController;
use App\Http\Controllers\PoliklinikController;
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

Route::prefix('v1')->group(function () {
    Route::apiResource('/dokter', DokterController::class);
    Route::apiResource('/poliklinik', PoliklinikController::class);
    Route::apiResource('/pelayanan', PelayananController::class);
    Route::apiResource('/history', HistoryController::class);
    Route::post('/get-antri', [PelayananController::class, 'getAntri']);
    Route::post('/get-dokter', [DokterController::class, 'getDokter']);
    Route::get('/data-poliklinik', [PoliklinikController::class, 'getPoli']);
});

Route::post('login-dokter', [AuthDokterController::class, 'login']);
Route::post('is-auth', [AuthDokterController::class, 'isAuth']);
Route::post('logout-dokter', [AuthDokterController::class, 'logout']);

Route::post('login-user', [AuthUserController::class, 'loginUser']);
Route::post('logout-user', [AuthUserController::class, 'logout']);
Route::post('is-auth-user', [AuthUserController::class, 'isAuth']);
