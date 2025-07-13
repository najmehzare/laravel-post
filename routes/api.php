<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;

Route::prefix('posts')->as('post.')->controller(PostController::class)->group(function () {

    Route::get('/', 'index')
        ->name('index');

    Route::post('/store', 'store')
        ->middleware('permission:post_store')
        ->middleware(['auth:sanctum'])
        ->name('store');

});

//get user data for test
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

//get user token for test
Route::get('/auth', function () {
    $user = \App\Models\User::whereEmail('admin@example.com')->first()->createToken('myapp');
    return $user;
});
