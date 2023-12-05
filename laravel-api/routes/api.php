<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\FormController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::get('/form', [FormController::class, 'index']);
    Route::post('/form/create', [FormController::class, 'store']);
    Route::get('/form/edit/{form}', [FormController::class, 'edit']);
    Route::put('/form/update/{form}', [FormController::class, 'update']);
    Route::delete('/form/delete/{form}', [FormController::class, 'destroy']);
    Route::post('/logout', [UserController::class, 'logout']);
});

Route::post('/login', [UserController::class, 'login'])->name('user.login');
Route::post('/register', [UserController::class, 'register'])->name('user.register');
