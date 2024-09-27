<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;


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

// Authenticated User Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();

        if ($user) {
            // Check the role (assuming 1 is admin)
            if ($user->role == 1) {
                return redirect()->route('admin.dashboard'); // Redirect to admin dashboard
            } else {
                return redirect()->route('customer.dashboard'); // Redirect to customer dashboard
            }
        }

        return redirect()->route('home')->with('error', 'You must be logged in to access the dashboard.');
    })->name('dashboard');
// Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/issuedetail', [AdminController::class, 'issuedetail'])->name('admin.issuedetail');
    Route::get('/admin/ticket/{id}', [AdminController::class, 'show'])->name('ticket.show');
    Route::post('/admin/submit-response', [AdminController::class, 'storerespons'])->name('submit_response');
    Route::get('/admin/stop-ticket/{id}', [AdminController::class, 'stopTicket'])->name('stop_ticket');

});

// Customer Routes
Route::middleware(['auth', 'customer'])->group(function () {
    Route::get('/customer/dashboard', [CustomerController::class, 'index'])->name('customer.dashboard');
    Route::get('/customer/createticket', [CustomerController::class, 'create_ticket'])->name('create_ticket');
    Route::post('/customer/submit-issue', [CustomerController::class, 'submitIssue'])->name('submit_issue');
});

require __DIR__.'/auth.php';
