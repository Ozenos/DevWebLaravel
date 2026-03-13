<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tickets', [PageController::class, 'list']);
Route::get('/ticketsOLD', [PageController::class, 'ticketsOLD']);
Route::get('/about', [PageController::class, 'about']);             // Static page using layout
