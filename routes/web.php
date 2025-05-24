<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AuthController;

// Quick DB test route (no auth required)
Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        $dbName = DB::connection()->getDatabaseName();
        return "✅ Connected successfully to database: <strong>{$dbName}</strong>";
    } catch (\Exception $e) {
        return "❌ Database connection error: " . $e->getMessage();
    }
});

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.user');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Password reset routes
Route::get('/forget-password', [AuthController::class, 'forgotPassword'])->name('forgot.password');
Route::post('/forgot-password', [AuthController::class, 'forgotPasswordPost'])->name('forgot.password.post');
Route::get('/reset-password/{token}', [AuthController::class, 'resetPassword'])->name('reset.password');
Route::post('/reset-password', [AuthController::class, 'resetPasswordPost'])->name('reset.password.post');

// Debug route to show last 20 lines of laravel.log
Route::get('/debug-log', function () {
    $logPath = storage_path('logs/laravel.log');
    if (!file_exists($logPath)) {
        return response()->json(['error' => 'Log file not found.']);
    }
    $log = file($logPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $lastLines = array_slice($log, -20);
    return response()->json(['last_lines' => $lastLines]);
});

// Debug route to run migrations (use carefully!)
Route::get('/run-migrations', function () {
    Artisan::call('migrate', ['--force' => true]);
    return '✅ Migrations run successfully';
});


// Authenticated routes
Route::middleware(['auth'])->group(function () {

    Route::get('/owner/dashboard', [AuthController::class, 'index'])->name('owner.dashboard');

    Route::get('/change-password', [AuthController::class, 'changePassword'])->name('change.password');
    Route::post('/update-password', [AuthController::class, 'changePasswordUpdate'])->name('change.password.update');

    Route::post('/appointment-store', [AuthController::class, 'store'])->name('appointment.store');

    // Admin dashboard route (make sure to create the view)
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

});
