<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseMasterController;
use App\Http\Controllers\JobController;
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
Route::apiResource('job', JobController::class);
Route::apiResource('user', UserController::class);
Route::apiResource('course', CourseController::class);
Route::apiResource('cormaster', CourseMasterController::class);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
