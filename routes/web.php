<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;

// Route halaman dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Route halaman login
Route::get('/login', [AuthController::class, 'login'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'loginProcess'])->name('login-process');
Route::get('/activate/request/{id}', [AuthController::class, 'activateRequest'])->name('activate.request');

// Route halaman daftar sebagai peminjam
Route::get('/register', [AuthController::class, 'register'])->middleware('guest')->name('register');
Route::post('/register', [AuthController::class, 'registerProcess'])->middleware('guest')->name('register-process');

// Route logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// ================= Resource Route ====================

// Rooms
Route::middleware('rolecheck:1')->group(function () {
    Route::get('/room', [RoomController::class, 'index'])->name('room.index');
    Route::post('/room/store', [RoomController::class, 'store'])->name('room.store');
    Route::put('/room/update', [RoomController::class, 'update'])->name('room.update');
    Route::delete('/room/destroy/{id}', [RoomController::class, 'destroy'])->name('room.destroy');

    // Disable & Enable user
    Route::get('/user/enable/{id}', [UserController::class, 'enable'])->name('user.enable');
    Route::put('/user/disable/{id}', [UserController::class, 'disable'])->name('user.disable');
});

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

        // Notes
        Route::get('/note/upload/{id}', [NoteController::class, 'upload'])->name('note.upload');
        Route::post('/note/store', [NoteController::class, 'store'])->name('note.store');
        Route::get('/note/broadcast/{noteId}', [NoteController::class, 'broadcast'])->name('note.broadcast');
    }
);

// Hanya Admin & Petugas yang bisa approve/decline pengajuan
Route::middleware('rolecheck:1,2')->group(
    function () {
        Route::get('/schedule/search', [ScheduleController::class, 'search'])->name('schedule.search');
        Route::get('/schedule/approve/{id}', [ScheduleController::class, 'scheduleProses'])->name('schedule.approve');
        Route::post('/schedule/decline', [ScheduleController::class, 'scheduleDecline'])->name('schedule.decline');
    }
);

Route::get('/change-month/{current}/{counter}', [ScheduleController::class, 'changeMonth'])->name('change-month');
Route::resource('schedule', ScheduleController::class)->middleware('rolecheck:1,2');

// Demo
//Route::get('/reset', [ScheduleController::class, 'reset']);
Route::get('/demo', [ScheduleController::class, 'demo']);
Route::get('/demo2', [ScheduleController::class, 'demo2']);
Route::get('/demo3', [ScheduleController::class, 'demo3']);
Route::get('/demo4', [ScheduleController::class, 'demo4']);
Route::get('/prepare', [ScheduleController::class, 'prepare']);
Route::get('/add-pending/{n}', [ScheduleController::class, 'addPending']);
Route::get('/add-expired/{n}', [ScheduleController::class, 'addExpired']);
