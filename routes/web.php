<?php

use App\Http\Controllers\FormationController;
use App\Http\Controllers\UtilisatorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login',[UtilisatorController::class,'login']);

Route::resource('/formation',FormationController::class);
