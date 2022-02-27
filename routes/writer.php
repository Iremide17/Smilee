<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Writer\DashboardController;

Route::group(['prefix' => 'writer', 'as' => 'writer.'], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');

});
