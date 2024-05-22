<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\Admin\GoogleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;

Route::get('/', function () {
    return redirect()->route('login');
    // return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::resource('dashboard', DashboardController::class);
    Route::get('alternate', [DashboardController::class, 'alternate'])->name('alternate');
    Route::get('email-box', [DashboardController::class, 'emailBox'])->name('email-box');
    Route::get('chat-box', [DashboardController::class, 'chatBox'])->name('chat-box');
    Route::get('file-manager', [DashboardController::class, 'fileManager'])->name('file-manager');
    Route::get('app-contact-list', [DashboardController::class, 'appContactList'])->name('app-contact-list');
    Route::get('app-to-do', [DashboardController::class, 'appToDo'])->name('app-to-do');
    Route::get('app-invoice', [DashboardController::class, 'appInvoice'])->name('app-invoice');
    Route::get('app-fullcalender', [DashboardController::class, 'appFullcalender'])->name('app-fullcalender');
    Route::get('widgets', [DashboardController::class, 'widgets'])->name('widgets');
    Route::get('ecommerce-products', [DashboardController::class, 'ecommerceProducts'])->name('ecommerce-products');
    Route::get('ecommerce-products-details', [DashboardController::class, 'ecommerceProductsDetails'])->name('ecommerce-products-details');
    Route::get('ecommerce-add-new-products', [DashboardController::class, 'ecommerceAddNewProducts'])->name('ecommerce-add-new-products');
    Route::get('ecommerce-orders', [DashboardController::class, 'ecommerceOrders'])->name('ecommerce-orders');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);




    // Route to initiate Google OAuth flow
    Route::get('/auth/google-gmail', [GoogleController::class, 'redirectToGoogle']);

    // Route to handle the Google OAuth callback
    Route::any('/auth/google-gmail/callback', [GoogleController::class, 'handleGoogleCallback']);

    // Route to list emails (protected by auth middleware)
    Route::get('/emails', [GoogleController::class, 'listEmails'])->middleware('auth');

    // Route to show send email form (protected by auth middleware)
    Route::get('/emails/send', function () {
        return view('emails.send');
    });

    // Route to handle sending emails (protected by auth middleware)
    Route::post('/send-email', [GoogleController::class, 'sendEmail'])->middleware('auth');
});

Route::get('auth/google', [SocialController::class, 'redirectToGoogle']);
Route::any('auth/google/callback', [SocialController::class, 'handleGoogleCallback']);

Route::get('auth/facebook', [SocialController::class, 'redirectToFacebook']);
Route::any('auth/facebook/callback', [SocialController::class, 'handleFacebookCallback']);

Route::get('auth/apple', [SocialController::class, 'redirectToApple']);
Route::any('auth/apple/callback', [SocialController::class, 'handleAppleCallback']);

Route::get('auth/linkedin', [SocialController::class, 'redirectToLinkedIn']);
Route::any('auth/linkedin/callback', [SocialController::class, 'handleLinkedInCallback']);


require __DIR__ . '/auth.php';
