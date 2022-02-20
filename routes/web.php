<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NoteController;

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
Route::middleware('rolecheck:3')->group(
    function () {
        Route::get('/request', [ScheduleController::class, 'request'])->name('request');
        Route::post('/request', [ScheduleController::class, 'requestProcess'])->name('request-process');
    }
);

Route::middleware('rolecheck:1,2')->group(
    function () {
        Route::get('/schedule/approve/{id}', [ScheduleController::class, 'scheduleProses'])->name('schedule.approve');
        Route::post('/schedule/decline', [ScheduleController::class, 'scheduleDecline'])->name('schedule.decline');
    }
);

Route::get('/change-month/{current}/{counter}', [ScheduleController::class, 'changeMonth'])->name('change-month');
Route::resource('schedule', ScheduleController::class)->middleware('rolecheck:1,2');

// Notes
Route::post('/note/store', [NoteController::class, 'store'])->name('note.store');
Route::get('/note/broadcast/{noteId}', [NoteController::class, 'broadcast'])->name('note.broadcast');
