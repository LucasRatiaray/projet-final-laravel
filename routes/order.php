<?php

use Illuminate\Support\Facades\Route;

Route::get('/orders', function () {
    return view('orders.index');
})->name('orders.index');
