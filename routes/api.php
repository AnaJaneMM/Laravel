<?php

use App\Http\Controllers\Api\VehicleController;
use App\Http\Controllers\Api\InsuranceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('vehicles', VehicleController::class);
Route::apiResource('insurances', InsuranceController::class);
