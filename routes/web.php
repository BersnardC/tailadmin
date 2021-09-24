<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TailsController;

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

Route::get('/', [TailsController::class, 'dashboard'])->name('dashboard');
Route::get('load_data', [TailsController::class, 'load_data'])->name('load_data');
Route::get('best_time', [TailsController::class, 'get_best_time']);
Route::get('stimated_time/{id}', [TailsController::class, 'get_tails_times']);