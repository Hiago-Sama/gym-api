<?php

use App\Http\Controllers\ExampleImportController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'import'], function () {
    Route::post('/', ExampleImportController::class);
});
