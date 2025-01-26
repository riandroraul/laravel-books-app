<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookCategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'registration']);
});

// BookCategory Service
Route::prefix('book-category')->group(function () {
    Route::get('/', [BookCategoryController::class, 'index'])->middleware('auth:sanctum');
    Route::post('/create', [BookCategoryController::class, 'create'])->middleware('auth:sanctum');
    Route::put('/update', [BookCategoryController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('/remove/{id}', [BookCategoryController::class, 'remove'])->middleware('auth:sanctum');
});
