<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseMasterController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------

| php artisan config:cache
php artisan route:clear

| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//auth routes
Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::get('refresh', [AuthController::class, 'refresh']);
    Route::post('send-reset-code', [AuthController::class, 'sendResetCode']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('user', [AuthController::class, 'user']);
        Route::post('logout', [AuthController::class, 'logout']);
    });
});


Route::apiResource('job', JobController::class);
Route::apiResource('user', UserController::class);
Route::apiResource('course', CourseController::class);
Route::apiResource('cormaster', CourseMasterController::class);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::apiResource('department', DepartmentController::class);
    Route::apiResource('course-master', CourseMasterController::class);

    Route::apiResource('setting', SettingController::class);
});
