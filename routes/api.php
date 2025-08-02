<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BlockController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\GiftController;

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




Route::prefix('auth')->controller(AuthController::class)->group(function ($q) {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('verify', 'verify');
    Route::middleware(['auth:sanctum'])->group(function ($q) {
        Route::post('deleteAccount', 'deleteAccount');
        Route::post('logout', 'logout');
        Route::get('user', 'getUser');
        Route::post('update-profile', 'updateProfile');
        Route::post('change-password', 'changePassword');
    });
});

Route::group(['controller' => ContactController::class], function ($q) {
    Route::post('search', 'search');
    Route::post('add-contacts', 'addContacts');
    Route::get('contact/{phone}/show', 'show');
});
Route::group(['controller' => BlockController::class], function ($q) {
    Route::post('block', 'toggle');
    Route::get('blocks', 'index');
    Route::get('intruders', 'Intruders');
});
Route::group(['controller' => GiftController::class], function ($q) {
    Route::get('gifts', 'index');
    Route::post('gifts/search', 'search');
    // Route::get('intruders', 'Intruders');
});