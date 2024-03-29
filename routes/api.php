<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
Route::prefix('v1')->group(function () {
    Route::get('/', function () {
        return response()->json([
            'sucess' => true,
            'message' => 'Laravel Rotinas'
        ]);
    });

    Route::prefix('users')->group(function () {
        Route::get('/scheduled-resignations', [UserController::class, 'listScheduledResignation']);
        Route::get('/', [UserController::class, 'index']);
        Route::post('/', [UserController::class, 'create']);
        Route::get('/{id}', [UserController::class, 'show']);        
        Route::patch('/{id}/scheduled-resignation', [UserController::class, 'scheduledResignation']);
        Route::patch('/{id}/scheduled-resignation/cancel', [UserController::class, 'cancelScheduledResignation']);
    });
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
