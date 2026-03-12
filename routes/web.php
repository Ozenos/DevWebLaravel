<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tickets', [PageController::class, 'tickets']);
Route::get('/tickets2', [PageController::class, 'tickets2']);
Route::get('/about', [PageController::class, 'about']);

# DEBUG ZONE
use Illuminate\Support\Facades\DB;

Route::get('/usersDB', function () {
    $users = DB::table('users')->get(); // récupère toutes les lignes
    foreach ($users as $user) {
        echo "ID: {$user->ID}, Name: {$user->name}, Email: {$user->email} <br>";
    }
});
Route::get('/ticketsDB', function () {
    $tickets = DB::table('tickets')->get(); // récupère toutes les lignes
    foreach ($tickets as $ticket) {
        echo "ID: {$ticket->ID}, Name: {$ticket->title} <br>";
    }
});