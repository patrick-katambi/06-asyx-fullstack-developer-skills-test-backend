<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Priority;
use App\Models\UserGroup;
use Illuminate\Http\Response;

Route::post('/user/register', [UserController::class, 'userRegistration']);
Route::post('/user/login', [UserController::class, 'userLogin']);
Route::get('/user/stuff', function () {
    $users = Priority::find(1)->tickets;
    return response(['user_group-users' => $users]);
});
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user/logout/{user_id}', [UserController::class, 'logOut']);
});
