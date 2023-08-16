<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AttractionController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/countries', [CountryController::class, 'index']);
Route::get('/countries/{id}', [CountryController::class, 'show']);

Route::get('/cities', [CityController::class, 'index']);
Route::get('/cities/{id}', [CityController::class, 'show']);

Route::get('/attractions', [AttractionController::class, 'index']);
Route::get('/attractions/{id}', [AttractionController::class, 'show']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function (Request $request) {
        return auth()->user();
    });

    Route::resource('/countries', CountryController::class)
        ->only(['store', 'update', 'destroy']);

    Route::resource('/cities', CityController::class)
        ->only(['store', 'update', 'destroy']);

    Route::resource('/attractions', AttractionController::class)
        ->only(['store', 'update', 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
});
