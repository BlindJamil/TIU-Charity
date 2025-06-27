<?php

use App\Http\Controllers\VolunteeringController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DonationController; // Original, keep if needed elsewhere
use App\Http\Controllers\CauseController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserDonationController;
use App\Http\Controllers\AdminDonationController;
use App\Http\Controllers\AdminManagementController; // <-- Added Controller
use App\Http\Middleware\IsAdmin; // Original, keep if needed elsewhere
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

/*
|--------------------------------------------------------------------------
| Public Routes (Accessible to Everyone)
|--------------------------------------------------------------------------
*/
Route::get('/', function () { return view('welcome'); })->name('home');
Route::get('/about', function () { return view('about'); })->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/faq', function () { return view('FAQ'); })->name('FAQ');
Route::get('/privacy-policy', function () { return view('privacy-policy'); })->name('privacy.policy');

// Cause Routes
Route::get('/cause', [CauseController::class, 'publicIndex'])->name('cause');

// Improved Donation Routes
Route::get('/donate/{id}', [UserDonationController::class, 'showForm'])->name('donation.form');
Route::post('/donate', [UserDonationController::class, 'store'])->name('donate');
Route::get('/donation/thank-you/{id}', [UserDonationController::class, 'thankYou'])->name('donation.thank-you');
Route::post('/donation/callback', [UserDonationController::class, 'handlePaymentCallback'])->name('donation.callback');

// Volunteer Routes
Route::get('/volunteer', [VolunteeringController::class, 'index'])->name('volunteer');
Route::post('/volunteer', [VolunteeringController::class, 'store'])->middleware('auth')->name('volunteer.store');

/*
|--------------------------------------------------------------------------
| Authentication & User Dashboard
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);

Route::get('/dashboard', function () {
    if (!Auth::check()) {
        return redirect('/login');
    }
    return redirect()->route('profile.dashboard');

})->middleware(['auth', 'verified'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| Admin Routes (Only Accessible by Admins)
|--------------------------------------------------------------------------
*/
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard (accessible to any admin)
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Settings (restricted to super admin)
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings')->middleware('permission:manage_admins');
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('updateSettings')->middleware('permission:manage_admins');

    // Campaigns Management
    Route::get('/causes', [CauseController::class, 'index'])->name('causes.index')->middleware('permission:view_campaigns');
    Route::get('/causes/create', [CauseController::class, 'create'])->name('causes.create')->middleware('permission:manage_campaigns');
    Route::post('/causes', [CauseController::class, 'store'])->name('causes.store')->middleware('permission:manage_campaigns');
    Route::get('/causes/{id}/edit', [CauseController::class, 'edit'])->name('causes.edit')->middleware('permission:manage_campaigns');
    Route::put('/causes/{id}', [CauseController::class, 'update'])->name('causes.update')->middleware('permission:manage_campaigns');
    Route::delete('/causes/{id}', [CauseController::class, 'destroy'])->name('causes.destroy')->middleware('permission:manage_campaigns');

    // Recent Campaigns Management
    Route::post('/causes/store-recent-donation', [CauseController::class, 'storeRecentDonation'])->name('causes.store-recent-donation')->middleware('permission:manage_campaigns');

    // Donation Dashboard (Original route)
    Route::get('/donations', [AdminController::class, 'donations'])->name('donations')->middleware('permission:view_donations');

    // Improved Donation Management Routes
    Route::get('/donation-details', [AdminDonationController::class, 'index'])->name('donations.index')->middleware('permission:view_donations');
    Route::get('/donation-details/export', [AdminDonationController::class, 'export'])->name('donations.export')->middleware('permission:manage_donations');
    Route::get('/donation-details/{id}', [AdminDonationController::class, 'show'])->name('donations.show')->middleware('permission:view_donations');
    Route::put('/donation-details/{id}', [AdminDonationController::class, 'update'])->name('donations.update')->middleware('permission:manage_donations');
    Route::post('/donation-details/thank-you/{id}', [AdminDonationController::class, 'sendThankYou'])->name('donations.thank-you')->middleware('permission:manage_donations');

    // Contact Messages
    Route::get('/messages', [ContactController::class, 'adminIndex'])->name('messages.index')->middleware('permission:view_messages');
    Route::post('/messages/{id}/read', [ContactController::class, 'markAsRead'])->name('messages.mark-read')->middleware('permission:manage_messages');

    // Volunteer Project Management
    Route::get('/projects', [VolunteeringController::class, 'adminIndex'])->name('projects.index')->middleware('permission:view_volunteers');
    Route::get('/projects/create', [VolunteeringController::class, 'create'])->name('projects.create')->middleware('permission:manage_volunteers');
    Route::post('/projects', [VolunteeringController::class, 'storeProject'])->name('projects.store')->middleware('permission:manage_volunteers');
    Route::get('/projects/{id}/edit', [VolunteeringController::class, 'edit'])->name('projects.edit')->middleware('permission:manage_volunteers');
    Route::put('/projects/{id}', [VolunteeringController::class, 'update'])->name('projects.update')->middleware('permission:manage_volunteers');
    Route::delete('/projects/{id}', [VolunteeringController::class, 'destroy'])->name('projects.destroy')->middleware('permission:manage_volunteers');

    // Volunteer Application Management
    Route::post('/volunteers/{id}/approve', [VolunteeringController::class, 'approveVolunteer'])->name('volunteers.approve')->middleware('permission:manage_volunteers');
    Route::post('/volunteers/{id}/reject', [VolunteeringController::class, 'rejectVolunteer'])->name('volunteers.reject')->middleware('permission:manage_volunteers');
    Route::post('/volunteers/{id}/reset', [VolunteeringController::class, 'resetVolunteer'])->name('volunteers.reset')->middleware('permission:manage_volunteers');

    // --- Admin User Management Routes (already correctly set up) ---
    Route::prefix('admins')->name('admins.')->middleware('permission:manage_admins')->group(function () {
        Route::get('/', [AdminManagementController::class, 'indexAdmins'])->name('index');
        Route::get('/create', [AdminManagementController::class, 'createAdmin'])->name('create');
        Route::post('/', [AdminManagementController::class, 'storeAdmin'])->name('store');
        Route::get('/{admin}/edit', [AdminManagementController::class, 'editAdmin'])->name('edit');
        Route::put('/{admin}', [AdminManagementController::class, 'updateAdmin'])->name('update');
        Route::delete('/{admin}', [AdminManagementController::class, 'destroyAdmin'])->name('destroy');
    });

    // Admin Logout
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

}); // End of admin group

/*
|--------------------------------------------------------------------------
| Profile Routes (Authenticated Users Only)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'dashboard'])->name('dashboard');
    Route::get('/information', [ProfileController::class, 'edit'])->name('edit');
    Route::patch('/information', [ProfileController::class, 'update'])->name('update');
    Route::post('/update-image', [ProfileController::class, 'updateProfileImage'])->name('update-image');
    Route::delete('/remove-image', [ProfileController::class, 'removeProfileImage'])->name('remove-image');
    Route::get('/password', [ProfileController::class, 'editPassword'])->name('password.edit');
    Route::get('/donations', [ProfileController::class, 'donations'])->name('donations');
    Route::get('/volunteer', [ProfileController::class, 'volunteer'])->name('volunteer');
    Route::get('/delete', [ProfileController::class, 'deleteAccount'])->name('delete');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    Route::get('/notifications/mark-all-read', [ProfileController::class, 'markAllNotificationsAsRead'])->name('notifications.mark-all-read');
});

// Remove the Test & Debug Routes before production.

// Breeze Authentication Routes for regular users
require __DIR__.'/auth.php';