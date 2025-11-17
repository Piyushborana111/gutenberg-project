<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;

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

// Public Book API routes
Route::prefix('books')->group(function (): void {
    // GET /api/books
    Route::get('/', [BookController::class, 'index'])->name('api.books.index');

    // GET /api/books/{id}
    Route::get('/{id}', [BookController::class, 'show'])->name('api.books.show');
});
