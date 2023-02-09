<?php

use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['as' => 'api.v1.', 'prefix' => 'v1'], function () {
    Route::apiResource('groups', \App\Http\Controllers\Api\V1\GroupController::class);
});
