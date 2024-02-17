<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ProfileController;
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
    return redirect('/hotels');
})->name('index');

Route::prefix('/hotels')->group(function () {
    Route::get('/', [HotelController::class, 'index'])->name('hotels.index');
    Route::get('/{hotel}', [HotelController::class, 'show'])->name('hotels.show');
});

Route::middleware(['auth', 'verified'])->prefix('/bookings')->group(function () {
    Route::get('/', [BookingController::class, 'index'])->name('bookings.index');
    Route::post('/', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::delete('/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
