<?php

use App\Http\Controllers\Api\V1\CommentController;
use App\Http\Controllers\Api\V1\GroupController;
use App\Http\Controllers\Api\V1\TagController;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['as' => 'api.v1.', 'prefix' => 'v1'], function () {
    Route::get('groups/{group}/related', [GroupController::class, 'related'])->name('groups.related');
    Route::apiResources([
        'groups' => GroupController::class,
        'tags' => TagController::class,
        'comments' => CommentController::class,
    ]);
});
