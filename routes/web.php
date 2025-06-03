<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgenceController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/

/*Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('/admin/agences', AgenceController::class);
});*/
/*Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});*/
// Route commune de redirection après login
Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'agence') {
        return redirect()->route('agence.dashboard');
    } else {
        return redirect()->route('user.dashboard');
    }
})->middleware('auth')->name('dashboard');

// Dashboards spécifiques
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    // Routes agences accessibles uniquement par l'admin
    Route::prefix('admin/agences')->name('admin.agences.')->group(function () {
        Route::get('/', [AgenceController::class, 'index'])->name('index');
        Route::get('/create', [AgenceController::class, 'create'])->name('create');
        Route::post('/', [AgenceController::class, 'store'])->name('store');
        Route::get('/agences/{agence}/edit', [AgenceController::class, 'edit'])->name('admin.agences.edit');
        Route::put('/agences/{agence}', [AgenceController::class, 'update'])->name('admin.agences.update');
        Route::delete('/agences/{agence}', [AgenceController::class, 'destroy'])->name('admin.agences.destroy');
    });

    Route::get('/agence/dashboard', [AgenceController::class, 'dashboard'])->name('agence.dashboard');
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
});


require __DIR__.'/auth.php';
