<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ShortLinkController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Authentication
Route::controller(UserController::class)->group(function () {
    Route::get('/login', 'index')->name('login-page');
    Route::post('/logout', 'logout')->name('logout')->middleware('auth');
    Route::post('/login', 'login')->name('login');
});

// Super Admin 
Route::prefix('super-admin')
    ->middleware(['auth', 'role:superadmin'])
    ->controller(SuperAdminController::class)
    ->group(function () {
        Route::get('/', 'index')
            ->name('superadmin.dashboard');
        Route::get('companies', 'showCompanies')->name('superadmin.companies');
    });

// Admin
Route::get('/admin', [AdminController::class, 'index'])
    ->name('admin.dashboard')
    ->middleware(['auth', 'role:admin']);

// Member 
Route::get('/member', [MemberController::class, 'index'])
    ->name('member.dashboard')
    ->middleware(['auth', 'role:member']);

// Invitation
Route::prefix('invitation')
    ->controller(InvitationController::class)
    ->group(function () {
        Route::post('/store', 'store')->name('invitation.store')->middleware(['auth', 'role:superadmin,admin']);
        Route::get('/{token}', 'showRegistration');
        Route::post('/register', 'registerUser')->name('invitee.register');
    });

// Short Ursl
Route::prefix('short-link')
    ->controller(ShortLinkController::class)
    ->group(function () {
        Route::get('/', 'index')->name('short-link')->middleware(['auth', 'role:admin,member']);
        Route::post('/create', 'createLink')->name('short-link.create')->middleware(['auth', 'role:admin,member']);
        Route::get('/all', 'viewShortLinks')->name('short-link.all')->middleware('auth');
    });

Route::get('/', [ShortLinkController::class, 'showAllShortLinks'])->name('dashboard');
Route::get('/c/{code}', [ShortLinkController::class, 'redirectLink'])->name('short-link.redirect');


Route::fallback(function () {
    return redirect()->route('dashboard');
});
