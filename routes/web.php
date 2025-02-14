<?php

use Illuminate\Support\Facades\Route;


Route::view('/vehicles', 'vehicles');
Route::get('/', function () {
    return view('welcome');
});
Route::view('/insurances', 'insurances');
