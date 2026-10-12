<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ParentGuardianController;

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
    if (auth()->check()) {
        return redirect(route('dashboard'));
    }
    return view('welcome');
})->name('welcome');

// Test route: always render welcome (useful to preview guest layout when logged in)
Route::get('/home-guest', function () {
    return view('welcome');
})->name('home.guest');

// Public Pages
Route::get('/terms-of-use', function () {
    return view('public.terms-of-use');
})->name('terms-of-use');

Route::get('/privacy-policy', function () {
    return view('public.privacy-policy');
})->name('privacy-policy');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'show'])->name('login');
    Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'store']);
    
    Route::get('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'show'])->name('register');
    Route::post('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'store']);
});

Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'destroy'])->name('logout')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile Routes
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    // Students Routes
    Route::resource('students', StudentController::class);

    // Payments Routes
    Route::resource('payments', PaymentController::class);
    Route::get('receipts/{receipt}/print', [PaymentController::class, 'printReceipt'])->name('receipts.print');

    // Classrooms Routes
    Route::resource('classrooms', ClassroomController::class);

    // Parents Routes
    Route::resource('parents', ParentGuardianController::class);

    // Photo/Image serving route
    Route::get('/storage/{path}', function ($path) {
        $fullPath = storage_path('app/public/' . $path);
        
        if (!file_exists($fullPath)) {
            abort(404);
        }

        return response()->file($fullPath);
    })->where('path', '.*')->name('storage.file');
});


