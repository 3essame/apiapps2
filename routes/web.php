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

Auth::routes();

//redirect to vue routes
Route::get('/{any?}', function () {
    $settings =  DB::table('settings')->get();
    foreach ($settings as $s) {
        $s->value = json_decode($s->value);
    }
    return view('welcome', ['settings' => $settings]);
})->where('any', '^(?!api\/)[\/\w\.-]*');