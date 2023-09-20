<?php

use App\Http\Controllers\HallController;
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
// Route::get('/request/{hall}',[\App\Http\Controllers\RequestController::class,'addRequest'])->name('user.request'); 


// Route::get('index', [AdminController::class, 'craete'])->name('admin.create');
// Route::post('index', [AdminController::class, 'store'])->name('admin.store');

Route::get('/appointment/{hall}', \App\Http\Controllers\AppointmentController::class)->name('appointment'); 

Route::get('user/{hall}/createReq', [RequestController::class, 'create'])->name('user.createRequest');
Route::post('user/{hall}/storeReq', [RequestController::class, 'store'])->name('user.storeRequest');
Route::get('user/{user}/requests', [RequestController::class, 'showUserRequests'])->name('user.showUserRequests');
Route::get('rooms', [RequestController::class, 'rooms'])->name('rooms');

Route::resource('/hall',HallController::class);
Route::get('showRequests',[HallController::class,'showRequests']);
require __DIR__.'/auth.php';
