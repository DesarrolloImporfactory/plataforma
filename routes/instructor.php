<?php

use App\Http\Controllers\Instructor\InstructorController;
use App\Http\Livewire\Instructor\CursoCurriculum;
use App\Http\Livewire\Intructor\IntructorCursos;
use Illuminate\Support\Facades\Route;

Route::redirect('', 'instructor/cursos');
Route::get('cursos', IntructorCursos::class)->name('cursos.index')->middleware('can:View course');
Route::resource('cursos/admin', InstructorController::class)->names('cursos.admin');

Route::get('cursos/curriculum/{curso}',CursoCurriculum::class)->name('cursos.curriculum');