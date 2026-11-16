
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MyCoursesController;
use App\Http\Controllers\CourseController;

// Login
Route::get('/', [AuthController::class, 'showLogin'])
    ->name('login');

// Register
Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.store');

// Login Process
Route::post('/login', [AuthController::class, 'login'])
    ->name('login.store');

// Authenticated Routes
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    // Tasks
    Route::resource('tasks', TaskController::class)
        ->except(['show']);

    Route::patch('/tasks/{task}/complete', [TaskController::class, 'complete'])
        ->name('tasks.complete');

       // My Courses
    Route::get('/my-courses', [MyCoursesController::class, 'index'])
        ->name('my-courses');

    // Add Course
    Route::get('/courses/create', [CourseController::class, 'create'])
        ->name('courses.create');

    Route::post('/courses', [CourseController::class, 'store'])
        ->name('courses.store');

    // Edit Course
Route::get('/courses/{id}/edit', [CourseController::class, 'edit'])
    ->name('courses.edit');

// Update Course
Route::put('/courses/{id}', [CourseController::class, 'update'])
    ->name('courses.update');

// Delete Course
Route::delete('/courses/{id}', [CourseController::class, 'destroy'])
    ->name('courses.destroy');

// View Course
Route::get('/courses/{id}', [CourseController::class, 'show'])
    ->name('courses.show');

});
