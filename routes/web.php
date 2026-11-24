<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\TestController;
use App\Http\Middleware\EnsureAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/resources', [PageController::class, 'resources'])->name('resources');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/leaderboard', [PageController::class, 'leaderboard'])->name('leaderboard');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Forgot / reset password
    Route::get('/forgot-password', [PasswordResetController::class, 'showRequestForm'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])->middleware('throttle:5,1')->name('password.email');
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class, 'reset'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
    Route::get('/green-challenge', [PageController::class, 'challenge'])->name('challenge');

    Route::get('/levels/{level}', [LevelController::class, 'show'])->whereNumber('level')->name('levels.show');
    Route::post('/levels/{level}/activity', [LevelController::class, 'completeActivity'])->whereNumber('level')->name('levels.activity');
    Route::post('/levels/{level}/quiz', [LevelController::class, 'submitQuiz'])->whereNumber('level')->name('levels.quiz');

    Route::get('/tests/{type}', [TestController::class, 'show'])->whereIn('type', ['pre', 'post'])->name('tests.show');
    Route::post('/tests/{type}', [TestController::class, 'submit'])->whereIn('type', ['pre', 'post'])->name('tests.submit');

    Route::get('/survey', [SurveyController::class, 'show'])->name('survey.show');
    Route::post('/survey', [SurveyController::class, 'submit'])->name('survey.submit');
});

Route::middleware(['auth', EnsureAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/export', [AdminController::class, 'export'])->name('export');
});
