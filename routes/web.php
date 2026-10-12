<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Pertemuan 6 PBKK (Secure Academic Portal Database)
|--------------------------------------------------------------------------
| 1. Public Portfolio Routes:
|    - Beranda (/) and canonical alias (/beranda)
|    - Profil Mahasiswa (/profil-mahasiswa)
|    - Ide Agent & Submission (/ide-agent)
| 2. Authenticated Routes (Laravel Breeze):
|    - Dashboard (/dashboard) -> Displays logged-in user's Eloquent projects
|    - Profile management (/profile)
| 3. Auth Routes (Breeze login/register/logout/password)
*/

// Public academic showcase routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/beranda', [PageController::class, 'home'])->name('home.alias');
Route::get('/profil-mahasiswa', [PageController::class, 'profile'])->name('profile');
Route::get('/ide-agent', [PageController::class, 'idea'])->name('idea');
Route::post('/ide-agent', [PageController::class, 'submitIdea'])->name('idea.submit');

// Protected dashboard route (Eloquent user projects query)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Protected user profile management
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
