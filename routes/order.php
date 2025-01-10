<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

Route::middleware(['auth'])->group(function () {

    Route::resource('orders', OrderController::class);
    //->except(['create', 'show']);
    // ->only(['index', 'store', 'edit', 'update', 'destroy']);
});
