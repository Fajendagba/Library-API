<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum', 'throttle:40,1'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // GET /api/books - List all books (with pagination)
    // POST /api/books - Create a new book
    // GET /api/books/{book} - Get a specific book
    // PUT /api/books/{book} - Update a book
    // DELETE /api/books/{book} - Delete a book
    Route::apiResource('books', BookController::class);
});
