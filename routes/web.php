<?php

use App\Livewire\Modules\Auth\Pages\Auth;
use App\Livewire\Modules\Auth\Pages\Regis;
use App\Livewire\Modules\Categories\Pages\Categories;
use App\Livewire\Modules\Courses\Pages\Courses;
use App\Livewire\Modules\Dashboard\Pages\Dashboard;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::middleware('guest')->group(function () {
    Route::get('/login', Auth::class)->name('login');
    Route::get('/registration', Regis::class)->name('regis');
});
Route::middleware(['auth'])->group(function () {

    Route::get('/', Dashboard::class)->name('dashboard');

    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/categories-index', Categories::class)->name('index');
    });

    Route::prefix('courses')->name('courses.')->group(function () {
        Route::get('/courses-index', Courses::class)->name('index');
        Route::get('/lessons-index/{id}', Courses::class)->name('lessons.index');
    });

    // Route::middleware(['role:admin'])->group(function () {
    //     Route::get('/admin/dashboard', function () {
    //         return "Admin Dashboard";
    //     })->name('admin.dashboard');
    // });
});

// Livewire Route
