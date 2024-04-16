<?php

use App\Http\Controllers\scraperController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    if (Auth::check()) {
        $authController = app()->make(HomeController::class);
        return $authController->show();
    }

    $authController = app()->make(AuthController::class);
    return $authController->showLoginForm();
})->name('home');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/deleteRow', [HomeController::class, 'deleteRow'])->name('deleteRow');
