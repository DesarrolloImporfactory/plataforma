<?php

use App\Http\Controllers\Home\CourseController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Livewire\Course\StatusCourse;
use Illuminate\Support\Facades\Route;



Route::get('/', HomeController::class)->name('home');

Route::get('/cursos/index', CourseController::class)->name('cursos.index');

Route::get('/cursos/show/{curso}', [CourseController::class, 'show'])->name('cursos.show');

Route::post('/cursos/enrolled/{curso}', [CourseController::class, 'matricular'])->name('cursos.enrolled')->middleware('auth');

Route::get('/cursos/view/{curso}', StatusCourse::class)->name('cursos.view')->middleware('auth');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
