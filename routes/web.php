<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

// cuz project deployed on a sharing host. these routes gonna to help me handle migrations :D

// Route::get('/migrate', function () {
//     Artisan::call('migrate', [
//         '--force' => true,
//     ]);
//     dump('migrate done.');
// });

// Route::get('/fresh', function () {
//     Artisan::call('migrate:fresh', [
//         '--force' => true,
//     ]);
//     dump('migrate:fresh done.');
// });

// Route::get('/seed', function () {
//     Artisan::call('db:seed', [
//         '--force' => true,
//     ]);
//     dump('db:seed done.');
// });