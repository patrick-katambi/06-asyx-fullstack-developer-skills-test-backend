<?php

use App\Http\Controllers\ImpactLevelController;
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\ResolutionCodeController;
use App\Http\Controllers\TicketCategoryController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketStateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserGroupController;

# user registration
Route::post('/user/register', [UserController::class, 'userRegistration']);

# user login
Route::post('/user/login', [UserController::class, 'userLogin']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    # user logout
    Route::get('/user/logout/{user_id}', [UserController::class, 'logOut']);

    Route::get('/token', [UserController::class, 'tokenizer']);

    # users by group id
    Route::get('/users/{user_group_id}', [UserController::class, 'getUsersByUserGroup']);

    # priorities
    Route::get('/priorities', [PriorityController::class, 'index']);

    # impact levels
    Route::get('/impact', [ImpactLevelController::class, 'index']);

    # ticket states
    Route::get('/state', [TicketStateController::class, 'index']);

    # ticket categories
    Route::get('/categories', [TicketCategoryController::class, 'index']);

    # resolution codes
    Route::get('/resolution_codes', [ResolutionCodeController::class, 'index']);

    # user groups
    Route::get('/groups', [UserGroupController::class, 'index']);

    # users based o the group id
    Route::get('/groups/{group_id}', [UserGroupController::class, 'getUsers']);

    # tickets
    Route::get('/tickets', [TicketController::class, 'index']);
});
