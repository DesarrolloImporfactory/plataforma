<?php

use App\Http\Controllers\Home\CourseController;
use App\Http\Controllers\Instructor\InstructorController;
use App\Http\Livewire\Instructor\CursoCurriculum;
use App\Http\Livewire\Instructor\CursoEstudiantes;
use App\Http\Livewire\Intructor\IntructorCursos;
use Illuminate\Support\Facades\Route;

Route::redirect('', 'instructor/cursos');
Route::get('cursos', IntructorCursos::class)->name('cursos.index')->middleware('can:View course');
Route::resource('cursos/admin', InstructorController::class)->names('cursos.admin');

Route::get('cursos/curriculum/{curso}',CursoCurriculum::class)->name('cursos.curriculum');
Route::get('cursos/{curso}/metas',[CourseController::class,'metas'])->name('cursos.metas');
Route::get('cursos/estudiantes/{curso}',CursoEstudiantes::class)->name('cursos.estudiantes');
Route::post('cursos/estatus/{curso}',[CourseController::class,'estatus'])->name('cursos.estatus');
Route::get('cursos/{curso}/observaciones',[CourseController::class,'observaciones'])->name('cursos.observaciones');