<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AktivitasController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\PrestasiAkademikController;
use App\Http\Controllers\PrestasiNonAkademikController;
use App\Http\Controllers\FasilitasController;
use App\Models\PrestasiAkademik;
use App\Models\PrestasiNonAkademik;





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


Route::get('heroes', [HeroController::class, 'index']);
Route::get('/news', [NewsController::class, 'index']);
Route::get('/about', [AboutController::class, 'apiGet']);
Route::get('/prestasi', [PrestasiAkademikController::class, 'index']);
Route::get('/prestasiNon', [PrestasiNonAkademikController::class, 'index']);
Route::get('fasilitas', [FasilitasController::class, 'apiGet']);
Route::get('/aktivitas', [AktivitasController::class, 'index']);
Route::get('/alumni', [AlumniController::class, 'ApiGet']);