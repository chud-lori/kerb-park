<?php

use App\Http\Controllers\API\BayController;
use App\Http\Controllers\API\BookController;
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

Route::get('/bay/all', [BayController::class, 'getAllBays']);
Route::get('/bay/available', [BayController::class, 'getAvailableBays']);
Route::get('/bay/occupied', [BayController::class, 'getOccupiedBays']);
Route::get('/bay/check/{bayCode}', [BayController::class, 'checkAvailablity']);
Route::post('/bay', [BayController::class, 'addBay']);

// Book
Route::get('/book/{license_plate}', [BookController::class, 'getBook']);
Route::post('/book', [BookController::class, 'bookBay']);
Route::post('/book/pay', [BookController::class, 'pay']);
