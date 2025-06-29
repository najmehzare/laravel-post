<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;

Route::get('/posts', [PostController::class, 'index']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/posts', [PostController::class, 'store']);
});

Route::get('/user', function () {
    return \App\Models\User::whereEmail('test@example.com')->first()->createToken('myapp');
});
