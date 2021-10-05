<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LogsController;
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

Route::get('/', function () {
    return response()->json([
        'message' => 'Not allowed'
    ], 405);
});

Route::fallback(function () {
    return response()->json([
        'message' => 'Not implemented'
    ], 404);
});

Route::get('/token', [AuthController::class, 'token'])->name('token.get');

Route::get('/logs', [LogsController::class, 'index'])->name('logs.list');

Route::middleware('auth:api')->get('/me', function (Request $request) {
    return $request->user();
});
