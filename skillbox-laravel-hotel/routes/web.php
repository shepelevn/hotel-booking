<?php

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

/* TODO: Delete if route is not used */
Route::get('/welcome', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('welcome');

Route::get('/', function () {
    return redirect('/hotels');
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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
