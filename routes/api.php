<?php

use App\Http\Controllers\AnimatorController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\PivotController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\UtilisatorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('users', [UtilisatorController::class, 'index']);

Route::resource('formations', FormationController::class);

Route::get('themes',[ThemeController::class,"index"]);

Route::get('animateurs',[AnimatorController::class,"index"]);

Route::resource('pivot', PivotController::class);
Route::delete('pivot', [PivotController::class, 'destroy']);
