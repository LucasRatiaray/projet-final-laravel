<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {

    Route::resource('products', ProductController::class);
    //->except(['create', 'show']);
    // ->only(['index', 'store', 'edit', 'update', 'destroy']);
});
