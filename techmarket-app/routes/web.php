<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/transactions', function() {
    return view('transactions');
});

Route::get('/transfer', function() {
    return view('transfer');
});