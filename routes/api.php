<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\SearchRecordController;
use App\Http\Middleware\ApiTokenCheck;
use App\Models\Contact;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::prefix("v1")->group(function () {

    Route::middleware('auth:sanctum')->group(function () {

        Route::apiResource('contact', ContactController::class);

        Route::post("logout", [ApiAuthController::class, 'logout']);
        Route::post("logout-all", [ApiAuthController::class, 'logoutAll']);
        Route::get("devices", [ApiAuthController::class, 'devices']);

        Route::apiResource('favourite', FavouriteController::class)->only(['index', 'store', 'destroy']);
        Route::get("search-history", [SearchRecordController::class, 'index']);
        Route::delete("search-history/{id}", [SearchRecordController::class, 'destroy']);
        
        // routes for soft deleting action
        Route::get('trashed-contact', [ContactController::class, 'trashedIndex']);
        Route::get('trashed-contact/{id}', [ContactController::class, 'trashedShow']);
        Route::get('restore-contact/{id}', [ContactController::class, 'restore']);
        Route::delete('trashed-contact/{id}', [ContactController::class, 'forceDelete']);
    });


    Route::post("register", [ApiAuthController::class, 'register']);
    Route::post("login", [ApiAuthController::class, 'login']);
});
