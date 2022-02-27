<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Agent\AgentController;
use App\Http\Controllers\Agent\BookingController;
use App\Http\Controllers\Agent\PropertyController;
use App\Http\Controllers\Agent\DashboardController;

Route::group(['prefix' => 'agent', 'as' => 'agent.'], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');
 
    Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
        Route::get('{agent}', [AgentController::class, 'index'])->name('index');
        Route::get('/create', [AgentController::class, 'create'])->name('create');
        Route::post('/', [AgentController::class, 'store'])->name('store');
        Route::get('show/{agent}', [AgentController::class, 'show'])->name('show');
        Route::get('/edit/{agent}', [AgentController::class, 'edit'])->name('edit');
        Route::get('{agent}/{property}', [AgentController::class, 'property'])->name('property');
    });


    Route::group(['prefix' => 'properties', 'as' => 'properties.'], function () {
        Route::get('/home', [PropertyController::class, 'index'])->name('index');
        Route::get('/houses', [PropertyController::class, 'home'])->name('home');
        Route::get('/create', [PropertyController::class, 'create'])->name('create');
        Route::post('/', [PropertyController::class, 'store'])->name('store');
        Route::get('{property}', [PropertyController::class, 'show'])->name('show');
        Route::get('/view/{agent}', [PropertyController::class, 'property'])->name('property');
        Route::get('/edit/{property}', [PropertyController::class, 'edit'])->name('edit');
    });

    Route::group(['prefix' => 'bookings', 'as' => 'bookings.'], function () {
        Route::get('{agent}', [BookingController::class, 'index'])->name('index');
    });

});
