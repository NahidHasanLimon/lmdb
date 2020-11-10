<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\User\LoginController;
use App\Http\Controllers\Api\MovieController;
use App\Http\Controllers\Api\IndustryController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\TagsBlogController;
use App\Http\Controllers\CategoriesBlogController;
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
// https://www.positronx.io/laravel-jwt-authentication-tutorial-user-login-signup-api/
Route::group([
    'middleware' => 'api',
    'prefix' => 'user'

], function ($router) {

    // Route::post('login', [AuthController::class, 'login']);
    Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('user-profile', 'AuthController@userProfile');


    
});
Route::group([
    'middleware' => 'api',
], function ($router) {
	// for movies
Route::prefix('movies')->group(function () {

Route::get('/', [MovieController::class, 'index']);
Route::get('industries', [IndustryController::class, 'index']);
Route::get('countries', [CountryController::class, 'index']);
});
 // end of movies
// for Blog
Route::prefix('blog')->group(function () {
	// start of tag
	Route::prefix('tag')->group(function () {
		Route::get('/', [TagsBlogController::class, 'index']);
		Route::post('store', [TagsBlogController::class, 'store']);
		Route::post('update', [TagsBlogController::class, 'update']);
		Route::post('destroy', [TagsBlogController::class, 'destroy']);
		});
	// end of tag
	});
// end of Blog
});
// end of middleware api