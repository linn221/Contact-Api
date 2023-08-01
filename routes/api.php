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

        // Auth
        Route::post("logout", [ApiAuthController::class, 'logout']);
        Route::post("logout-all", [ApiAuthController::class, 'logoutAll']);
        Route::get("devices", [ApiAuthController::class, 'devices']);

        // Contacts
        Route::post('contact/bulk-delete', [ContactController::class, 'bulkDelete']);
        Route::apiResource('contact', ContactController::class);

        // Favourite
        Route::delete('favourite/reset', [FavouriteController::class, 'reset'])->name('favourite.reset');
        Route::apiResource('favourite', FavouriteController::class)->only(['index', 'store', 'destroy']);

        // Search Records
        Route::get("search-history", [SearchRecordController::class, 'index'])->name('search-history.index');
        Route::delete("search-history/{id}", [SearchRecordController::class, 'destroy'])->name('search-history.destroy');
        Route::delete("search-history/reset", [SearchRecordController::class, 'reset'])->name('search-history.reset');

        // Soft Delete
        Route::delete('trashed-contact/reset', [ContactController::class, 'reset'])->name('trashed.reset');
        Route::get('trashed-contact/restore', [ContactController::class, 'restoreAll']);
        Route::get('trashed-contact', [ContactController::class, 'trashedIndex'])->name('trashed.index');
        Route::get('trashed-contact/{id}', [ContactController::class, 'trashedShow'])->name('trashed.show');
        Route::get('restore-contact/{id}', [ContactController::class, 'restore'])->name('trashed.restore');
        Route::delete('trashed-contact/{id}', [ContactController::class, 'forceDelete'])->name('trashed.destroy');
    });


    Route::post("register", [ApiAuthController::class, 'register']);
    Route::post("login", [ApiAuthController::class, 'login']);
});
