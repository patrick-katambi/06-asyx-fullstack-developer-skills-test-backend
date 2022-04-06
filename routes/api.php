<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::post('/user/register', [UserController::class, 'userRegistration']);
Route::post('/user/login', [UserController::class, 'userLogin']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user/logout/{user_id}', [UserController::class, 'logOut']);
});
