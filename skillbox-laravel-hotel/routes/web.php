<?php

use App\Http\Controllers\HotelController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('index');

Route::prefix('/hotels')->group(function () {
    Route::get('/', [HotelController::class, 'index'])->name('hotels.index');
    /* Route::get('/{hotel}', [HotelController::class, 'show']); */
});

/* TODO: Delete later. Temporary solution, so frontend could work */

Route::get('/1', function () {
    return 'Not implemented';
})->name('bookings.index');

Route::get('/2', function () {
    return 'Not implemented';
})->name('hotels.show');
