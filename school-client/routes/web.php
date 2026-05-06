<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Teachers
Route::prefix('teachers')->name('teachers.')->group(function () {
    Route::get('/',           [TeacherController::class, 'index'])->name('index');
    Route::get('/create',     [TeacherController::class, 'create'])->name('create');
    Route::post('/',          [TeacherController::class, 'store'])->name('store');
    Route::get('/{id}',       [TeacherController::class, 'show'])->name('show');
    Route::get('/{id}/edit',  [TeacherController::class, 'edit'])->name('edit');
    Route::put('/{id}',       [TeacherController::class, 'update'])->name('update');
    Route::delete('/{id}',    [TeacherController::class, 'destroy'])->name('destroy');
});

// Students
Route::prefix('students')->name('students.')->group(function () {
    Route::get('/',           [StudentController::class, 'index'])->name('index');
    Route::get('/create',     [StudentController::class, 'create'])->name('create');
    Route::post('/',          [StudentController::class, 'store'])->name('store');
    Route::get('/{id}',       [StudentController::class, 'show'])->name('show');
    Route::get('/{id}/edit',  [StudentController::class, 'edit'])->name('edit');
    Route::put('/{id}',       [StudentController::class, 'update'])->name('update');
    Route::delete('/{id}',    [StudentController::class, 'destroy'])->name('destroy');
});

// Subjects
Route::prefix('subjects')->name('subjects.')->group(function () {
    Route::get('/',                          [SubjectController::class, 'index'])->name('index');
    Route::get('/create',                    [SubjectController::class, 'create'])->name('create');
    Route::post('/',                         [SubjectController::class, 'store'])->name('store');
    Route::get('/{id}',                      [SubjectController::class, 'show'])->name('show');
    Route::get('/{id}/edit',                 [SubjectController::class, 'edit'])->name('edit');
    Route::put('/{id}',                      [SubjectController::class, 'update'])->name('update');
    Route::delete('/{id}',                   [SubjectController::class, 'destroy'])->name('destroy');
    Route::post('/{id}/assign-teacher',      [SubjectController::class, 'assignTeacher'])->name('assign-teacher');
});
