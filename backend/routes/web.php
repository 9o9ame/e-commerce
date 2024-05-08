<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\SocialController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    // return view('admin/index');
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('auth/google', [SocialController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [SocialController::class, 'handleGoogleCallback']);

Route::get('auth/facebook', [SocialController::class, 'redirectToFacebook']);
Route::get('auth/facebook/callback', [SocialController::class, 'handleFacebookCallback']);

Route::get('auth/apple', [SocialController::class, 'redirectToApple']);
Route::get('auth/apple/callback', [SocialController::class, 'handleAppleCallback']);

Route::get('auth/linkedin', [SocialController::class, 'redirectToLinkedIn']);
Route::get('auth/linkedin/callback', [SocialController::class, 'handleLinkedInCallback']);


require __DIR__.'/auth.php';
