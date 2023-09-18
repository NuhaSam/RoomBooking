<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Redis;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/test/{id}', \App\Http\Controllers\AppointmentController::class); 
Route::get('/request/{hall}',[\App\Http\Controllers\AppointmentController::class,'request'])->name('user.request'); 


Route::get('index', [AdminController::class, 'craete'])->name('admin.create');
Route::post('index', [AdminController::class, 'store'])->name('admin.store');

Route::get('req', [RequestController::class, 'create'])->name('user.create');
Route::post('req/{hall}', [RequestController::class, 'store'])->name('request.store');
Route::get('rooms', [RequestController::class, 'rooms'])->name('request.rooms');

Route::resource('/hall',HallController::class);

require __DIR__.'/auth.php';
