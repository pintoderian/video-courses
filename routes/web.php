<?php

use App\Http\Controllers\HomepageController;
use App\Livewire\Forms\CourseForm;
use App\Livewire\Tables\CoursesIndex;

use App\Livewire\Forms\CategoryForm;
use App\Livewire\Tables\CategoryIndex;

use App\Livewire\Tables\VideoIndex;
use App\Livewire\Forms\VideoForm;

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

Route::get('/', [HomepageController::class, 'index'])->name('homepage.index');
Route::get('/course/{slug}', [HomepageController::class, 'course'])->name('homepage.course');
Route::get('/video/{slug}', [HomepageController::class, 'video'])->name('homepage.video');
Route::get('/category/{slug}', [HomepageController::class, 'category'])->name('homepage.category');
Route::get('/group/{slug}', [HomepageController::class, 'groupCourse'])->name('homepage.group');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::prefix('dashboard')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('courses', CoursesIndex::class)->name('courses.index');
    Route::get('courses/create', CourseForm::class)->name('courses.create');
    Route::get('courses/{courseId}/edit', CourseForm::class)->name('courses.edit');

    Route::get('categories', CategoryIndex::class)->name('categories.index');
    Route::get('categories/create', CategoryForm::class)->name('categories.create');
    Route::get('categories/{categoryId}/edit', CategoryForm::class)->name('categories.edit');

    Route::get('videos', VideoIndex::class)->name('videos.index');
    Route::get('videos/create', VideoForm::class)->name('videos.create');
    Route::get('videos/{videoId}/edit', VideoForm::class)->name('videos.edit');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
