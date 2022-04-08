<?php

use Carbon\Carbon;
use App\Models\Schedule;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;


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
Route::middleware('rolecheck:1,2,3')->group(function () {
    Route::patch('/profile/edit', [UserController::class, 'profileEdit'])->name('profile.edit');
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
});

Route::get('/user/search', [UserController::class, 'search'])->name('user.search');
Route::resource('user', UserController::class)->middleware('rolecheck:1');

// Schedules
Route::middleware('rolecheck:3')->group(
    function () {
        Route::get('/request', [ScheduleController::class, 'request'])->name('request');
        Route::post('/request', [ScheduleController::class, 'requestProcess'])->name('request.process');
        Route::get('/request/edit/{id}', [ScheduleController::class, 'requestEdit'])->name('request.edit');
        Route::patch('/request/update/{id}', [ScheduleController::class, 'requestUpdate'])->name('request.update');
        Route::delete('/schedule/cancel/{id}', [ScheduleController::class, 'scheduleCancel'])->name('schedule.cancel');
        Route::get('/schedule/finish/{id}', [ScheduleController::class, 'scheduleFinish'])->name('schedule.finish');
    }
);

// Hanya Admin & Petugas yang bisa approve/decline pengajuan
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

// Demo H-10m
Route::get('/demo', [ScheduleController::class, 'demo']);
Route::get('/demo2', [ScheduleController::class, 'demo2']);
