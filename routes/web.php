<?php

use App\Mail\ScheduleRequested;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Mail\ScheduleApproved;
use App\Mail\ScheduleDeclined;
use App\Mail\ScheduleStarted;
use App\Models\Schedule;
use App\Models\User;

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

Route::get('/test', function () {
    dd(Schedule::getAlmostStarted(10));
});

Route::get('/mail', function () {
    // dd(User::getById(3)->only('name', 'email'));
    // Mail
    //     ::send(new ScheduleRequested([
    //         'date' => '2022-02-15',
    //         'start' => '09:00:00',
    //         'end' => '11:00:00',
    //         'description' => 'Rapat Penting Damamaya'
    //     ], 3));
    // Mail::send(new ScheduleDeclined(1, 2));
    Mail::send(new ScheduleStarted(2));
});

// Route halaman dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Route halaman login
Route::get('/login', [AuthController::class, 'login'])->middleware('guest')->name('login');

// Route validasi login
Route::post('/login', [AuthController::class, 'loginProcess'])->name('login-process');

// Route logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// ================= Resource Route ==================== 

// Users
Route::get('/user/search', [UserController::class, 'search'])->name('user.search');
Route::resource('user', UserController::class);

// Schedules
Route::get('/request', [ScheduleController::class, 'request'])->name('request');
Route::post('/request', [ScheduleController::class, 'requestProcess'])->name('request-process');
Route::get('/schedule/approve/{id}', [ScheduleController::class, 'scheduleProses'])->name('schedule.approve');
Route::get('/schedule/decline/{id}', [ScheduleController::class, 'scheduleDecline'])->name('schedule.decline');
Route::get('/change-month/{current}/{counter}', [ScheduleController::class, 'changeMonth'])->name('change-month');
Route::resource('schedule', ScheduleController::class);
