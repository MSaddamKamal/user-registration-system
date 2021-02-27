<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use Laravel\Passport\Passport;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });







Route::post('user-auth/signup', [RegisterController::class, 'register']);
Route::post('user-auth/login', [LoginController::class, 'login']);

Route::post('user-auth/logout', [LoginController::class, 'logout']);




Route::middleware(['auth:api', 'scope:check-profile'])->group(function () {

	Route::resource('profile',ProfileController::class);
	Route::get('activity/{id}',[ProfileController::class,'getUserActivity']);


});