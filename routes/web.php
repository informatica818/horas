<?php

use App\Http\Controllers\HorasController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect('/horas');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   
    Route::resource('horas', HorasController::class)->names('horas');
    Route::get('/horas/{id}/descargar', [HorasController::class, 'descargarArchivo'])->name('horas.descargar');
    Route::resource('users', UserController::class)->middleware('can:users.index')->names('users');
});

require __DIR__.'/auth.php';

//Route::resource('horas', HorasController::class)->middleware('can:horas.index')->names('horas');

