<?php

use App\Http\Controllers\Api\DeveloperController;
use App\Http\Controllers\Api\Languagecontroller;
use App\Http\Controllers\Api\OpportunityController;
use App\Http\Controllers\Api\UsedDeveloperController;
use App\Http\Controllers\Api\UsedDevLanguageController;
use App\Http\Controllers\Api\UserController;
use App\Models\Developer;
use App\Models\Opportunity;
use App\Models\UsedDevLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/test', function(){
    return "That is testing";
});

Route::post('/user', [UserController::class, 'store']);
Route::post('/login', [UserController::class, 'login']);


Route::get('redirect', [UserController::class, 'redirect'])->name('login');


Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/user', [UserController::class, 'index']);
    
    Route::get('/opportunity', [OpportunityController::class, 'index']);
    Route::post('/opportunity', [OpportunityController::class, 'store']);
    Route::post('/opportunity/{id}', [OpportunityController::class, 'update']);
    Route::delete('/opportunity/{id}', [OpportunityController::class, 'destroy']);

    Route::get('/language', [Languagecontroller::class, 'index']);
    Route::post('/language', [Languagecontroller::class, 'store']);
    Route::post('/language/{id}', [Languagecontroller::class, 'update']);
    Route::delete('/language/{id}', [Languagecontroller::class, 'destroy']);

    Route::get('/developer', [DeveloperController::class, 'index']);
    Route::post('/developer', [DeveloperController::class, 'store']);
    Route::post('/developer/{id}', [DeveloperController::class, 'update']);
    Route::delete('/developer/{id}', [DeveloperController::class, 'destroy']);

    Route::get('/developer/{id}', [DeveloperController::class, 'show']);

    Route::get('/used-dev-language', [UsedDevLanguageController::class, 'index']);
    Route::post('/used-dev-language', [UsedDevLanguageController::class, 'store']);
    Route::post('/used-dev-language/{id}', [UsedDevLanguageController::class, 'update']);
    Route::delete('/used-dev-language/{id}', [UsedDevLanguageController::class, 'destroy']);
});

