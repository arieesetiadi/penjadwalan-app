<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// route halaman dashboard
Route::get('/', [DashboardController::class, 'index']);

// route halaman login
Route::get('/login', [AuthController::class, 'login'])->middleware('guest')->name('login');

// route validasi login
Route::post('/login', [AuthController::class, 'loginProcess'])->name('loginProcess');

// route logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// ================= Resource Route ==================== 
Route::resources([
    'user' => UserController::class
]);
