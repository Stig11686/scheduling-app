<?php

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

Route::middleware(['auth:sanctum'])->group(function () {
    // Define routes that require authentication here
});

// Authentication routes
require __DIR__.'/auth.php';

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function(){
    Route::apiResource('/schedule', ScheduleController::class);
    Route::apiResource('/cohorts', CohortController::class);
    Route::apiResource('/courses', CourseController::class);
    Route::apiResource('/sessions', SessionController::class);
    Route::apiResource('/trainers', TrainerController::class);
});
