<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FormTypeController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name('home');

    Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
    Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.create');
    Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');
    Route::get('/documents/generate', [DocumentController::class, 'generateAll'])->name('documents.generate');
    Route::get('/documents/{id}/edit', [DocumentController::class, 'edit'])->name('documents.edit');
    Route::put('/documents/{id}', [DocumentController::class, 'update'])->name('documents.update');
    Route::delete('/documents/{id}', [DocumentController::class, 'destroy'])->name('documents.destroy');

    Route::get('/settings', [UserController::class, 'settings'])->name('settings');
    Route::post('/settings/password', [UserController::class, 'updatePassword'])->name('settings.password');
    Route::post('/settings/avatar', [UserController::class, 'updateAvatar'])->name('settings.avatar');

    Route::get('/form-types', [FormTypeController::class, 'index'])->name('form_types.index');
    Route::get('/form-types/create', [FormTypeController::class, 'create'])->name('form_types.create');
    Route::post('/form-types', [FormTypeController::class, 'store'])->name('form_types.store');
    Route::get('/form-types/{id}/edit', [FormTypeController::class, 'edit'])->name('form_types.edit');
    Route::put('/form-types/{id}', [FormTypeController::class, 'update'])->name('form_types.update');
    Route::delete('/form-types/{id}', [FormTypeController::class, 'destroy'])->name('form_types.destroy');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
