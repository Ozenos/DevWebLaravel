<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

Route::post('/tickets', [TicketController::class, 'storeApi'])->name('api.tickets.store');
Route::put('/tickets/{ticket}', [TicketController::class, 'updateApi'])->name('api.tickets.update');