<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/form', [FormController::class, 'index']);
Route::post('/form/create', [FormController::class, 'store']);
Route::get('/form/edit/{form}', [FormController::class, 'edit']);
Route::put('/form/update/{form}', [FormController::class, 'update']);
Route::delete('/form/delete/{form}', [FormController::class, 'destroy']);
