<?php

use App\Http\Controllers\Vendor\FurnitureController;
use App\Http\Controllers\Vendor\ProductController;
use App\Http\Controllers\Vendor\GalleryController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\DashboardController;

Route::group(['prefix' => 'vendor', 'as' => 'vendor.'], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');


    Route::group(['prefix' => 'furniture', 'as' => 'furniture.'], function () {
        Route::get('/create', [FurnitureController::class, 'create'])->name('create');
        Route::get('/{furniture}/edit', [FurnitureController::class, 'edit'])->name('edit');
        Route::post('/', [FurnitureController::class, 'store'])->name('store');
        Route::post('/{furniture}', [FurnitureController::class, 'update'])->name('update');
    });

    Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::post('/{product}', [ProductController::class, 'update'])->name('update');
        Route::delete('{product}', [ProductController::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'gallery', 'as' => 'gallery.'], function () {
        Route::get('/create', [GalleryController::class, 'create'])->name('create');
        Route::post('/', [GalleryController::class, 'store'])->name('store');
        Route::get('/{gallery}/edit', [GalleryController::class, 'edit'])->name('edit');
        Route::post('/{gallery}', [GalleryController::class, 'update'])->name('update');
    });

});
