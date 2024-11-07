<?php

use App\Livewire\Forms\CourseForm;
use App\Livewire\Tables\CoursesIndex;

use App\Livewire\Forms\CategoryForm;
use App\Livewire\Tables\CategoryIndex;

use Illuminate\Support\Facades\Route;

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

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('dashboard');

Route::prefix('dashboard')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('courses', CoursesIndex::class)->name('courses.index');
    Route::get('courses/create', CourseForm::class)->name('courses.create');
    Route::get('courses/{courseId}/edit', CourseForm::class)->name('courses.edit');

    Route::get('categories', CategoryIndex::class)->name('categories.index');
    Route::get('categories/create', CategoryForm::class)->name('categories.create');
    Route::get('categories/{categoryId}/edit', CategoryForm::class)->name('categories.edit');

    Route::get('videos', CoursesIndex::class)->name('videos.index');
    Route::get('videos/create', CourseForm::class)->name('videos.create');
    Route::get('videos/{course}/edit', CourseForm::class)->name('videos.edit');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
