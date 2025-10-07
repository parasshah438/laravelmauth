<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth', 'single.session']);


Route::get('/api/geo-location', [App\Http\Controllers\GeoLocationController::class, 'getCountryCode'])->name('api.geo.location');
Route::post('/api/location-details', [App\Http\Controllers\GeoLocationController::class, 'getLocationDetails'])->name('api.location.details');
Route::get('/api/location-from-ip', [App\Http\Controllers\GeoLocationController::class, 'getLocationFromIP'])->name('api.location.from.ip');
Route::get('/api/search-locations', [App\Http\Controllers\GeoLocationController::class, 'searchLocations'])->name('api.search.locations');
Route::get('/api/pincode-details', [App\Http\Controllers\GeoLocationController::class, 'getPincodeDetails'])->name('api.pincode.details');

//Admin routes
require __DIR__.'/admin.php';
