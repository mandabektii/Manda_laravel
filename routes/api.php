<?php

use App\Http\Controllers\ApiPendidikanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Api Route
Route::get('api_pendidikan', [ApiPendidikanController::class, 'getAll']);
Route::get('api_pendidikan/{id}', [ApiPendidikanController::class, 'getPen']);
Route::post('api_pendidikan', [ApiPendidikanController::class, 'createPen']);
Route::put('api_pendidikan/{id}', [ApiPendidikanController::class, 'updatePen']);
Route::delete('api_pendidikan/{id}', [ApiPendidikanController::class, 'deletePen']);