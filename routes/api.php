<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\RegisterUserController;
use App\Http\Controllers\Api\V1\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\V1\Auth\ChangePasswordController;
use App\Http\Controllers\Api\V1\Auth\AuthenticatedUserController;
use App\Http\Controllers\Api\V1\Auth\UpdateUserProfileController;

Route::get('/ping', function () {
    var_dump('pinged');
});


Route::prefix('v1')->group(function () {
    Route::post('/register', [RegisterUserController::class, 'register']);
    Route::post('login', [AuthenticatedUserController::class, 'login']);
    Route::post('logout', [AuthenticatedUserController::class, 'logout']);
    Route::post('change-password/{userid}', [ChangePasswordController::class, 'changePassword']);
    Route::post('forgot-password', [ForgotPasswordController::class, 'forgotPassword']);

});
