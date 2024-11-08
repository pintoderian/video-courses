<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\ProgressController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    // Listar cursos
    Route::get('courses', [CourseController::class, 'index']);

    // Buscar cursos
    Route::get('courses/search', [CourseController::class, 'search']);

    // Registrar usuario en curso
    Route::post('courses/{course}/register', [CourseController::class, 'registerUser']);

    // Ver videos del curso
    Route::get('courses/{course}/videos', [CourseController::class, 'videos']);

    // Subir comentarios
    Route::post('comments', [CommentController::class, 'store']);

    // Dar likes
    Route::post('comments/{comment}/like', [CommentController::class, 'like']);

    // Manejar progreso
    Route::post('progress/{course}/update', [ProgressController::class, 'update']);
});
