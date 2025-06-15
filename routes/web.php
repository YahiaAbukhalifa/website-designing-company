<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [FrontendController::class, 'home'])->name('home')->middleware('track.page.views');
Route::get('/portfolio', [FrontendController::class, 'portfolio'])->name('portfolio')->middleware('track.page.views');
Route::get('/order', [FrontendController::class, 'order'])->name('order')->middleware('track.page.views');
Route::post('/contact', [FrontendController::class, 'contactSubmit'])->name('contact.submit');
Route::post('/order', [FrontendController::class, 'orderSubmit'])->name('order.submit');
// Admin Routes
Route::prefix('admin')->group(function () {
    // Public routes (accessible without login)
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.post');

    // Protected routes (require login)
    Route::middleware(['admin.auth'])->group(function () {
        Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard')->middleware('track.admin.page.views');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
        
        // Contact Us routes
        Route::get('/contact-us', [ContactUsController::class, 'showList'])->name('admin.contact-us')->middleware('track.admin.page.views');
        Route::post('/contact-us/receivers', [ContactUsController::class, 'storeReceiver'])->name('admin.contact-us.receivers.store');
        Route::delete('/admin/contact/{id}', [ContactUsController::class, 'deleteContact'])->name('admin.contact.destroy');
        
        // Project routes
        Route::get('/projects', [ProjectController::class, 'index'])->name('admin.projects')->middleware('track.admin.page.views');
        Route::post('/projects', [ProjectController::class, 'store'])->name('admin.projects.store');
        Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('admin.projects.edit')->middleware('track.admin.page.views');
        Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('admin.projects.update');
        Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('admin.projects.destroy');
        
        // Project Requests routes
        Route::get('/project-requests', [ProjectController::class, 'projectRequests'])->name('admin.project-requests')->middleware('track.admin.page.views');
            });
});