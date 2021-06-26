<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('create-user', function () {
    return User::create(['name'=>'essam','department_id'=>1,'cevile_id'=>2]);

});

Route::get('update-user', function () {
    $user=User::find(1);
    $user->update(['name'=>'updated_essam']);
    return $user->load('department');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
