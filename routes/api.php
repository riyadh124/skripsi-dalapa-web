<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\WorkorderController;
use App\Models\Material;
use App\Http\Controllers\NotificationController;


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

Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/upload-image', [ImageController::class, 'upload']);
    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::resource('/workorder',WorkorderController::class);
    Route::get('/workorders-count', [WorkorderController::class, 'getWorkorderCount']);
    Route::get('/workorders', [WorkorderController::class, 'getListWorkorder']);
    Route::resource('/material',MaterialController::class);
    Route::get('/workorders/{workorder}/materials', [WorkorderController::class, 'getMaterials']);
    Route::put('/workorder/{id}/update-status', [WorkorderController::class, 'updateStatus']);
    Route::put('/workorder/{id}/input-data', [WorkorderController::class, 'inputData']);
});

