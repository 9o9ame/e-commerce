<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.index');
    // return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
});

Route::get('auth/google', [SocialController::class, 'redirectToGoogle']);
Route::any('auth/google/callback', [SocialController::class, 'handleGoogleCallback']);

Route::get('auth/facebook', [SocialController::class, 'redirectToFacebook']);
Route::any('auth/facebook/callback', [SocialController::class, 'handleFacebookCallback']);

Route::get('auth/apple', [SocialController::class, 'redirectToApple']);
Route::any('auth/apple/callback', [SocialController::class, 'handleAppleCallback']);

Route::get('auth/linkedin', [SocialController::class, 'redirectToLinkedIn']);
Route::any('auth/linkedin/callback', [SocialController::class, 'handleLinkedInCallback']);


require __DIR__.'/auth.php';
