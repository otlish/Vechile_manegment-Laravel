<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\VehicleController;

use App\Models\Vehicle;

Route::get('/', function () {
    $featuredVehicles = Vehicle::where('status', 'available')->latest()->take(3)->get();
    return view('welcome', compact('featuredVehicles'));
});


Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
Route::get('/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');
Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
Route::get('/vehicles/{vehicle}/edit', [VehicleController::class, 'edit'])->name('vehicles.edit');
Route::put('/vehicles/{vehicle}', [VehicleController::class, 'update'])->name('vehicles.update');
Route::delete('/vehicles/{vehicle}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');


// // vehicle  crud routes
// Route::get('/vehicles', [VehicleController::class, 'index']);

// // vehicle create route
// Route::get('/vehicles/create', [VehicleController::class,
//  'create']);

// // vehicle store route
// Route::post('/vehicles', [VehicleController::class, 'store']);

use App\Http\Controllers\CustomerController;

Route::get('/dashboard', [CustomerController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminVehicleController;

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/customers', [AdminController::class, 'customers'])->name('customers');
    Route::get('/rentals', [AdminController::class, 'rentals'])->name('rentals');
    Route::get('/returns', [AdminController::class, 'returns'])->name('returns');
    Route::post('/bookings/{booking}/return', [AdminController::class, 'returnVehicle'])->name('bookings.return');
    
    // Vehicle Management
    Route::resource('vehicles', AdminVehicleController::class);
});

Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/history', [CustomerController::class, 'history'])->name('history');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
