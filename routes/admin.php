<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Home\CourseController;
use App\Http\Livewire\Cursos\AdminCursos;
use App\Http\Livewire\Cursos\CursoShow;
use App\Http\Livewire\Roles\AdminRoles;
use App\Http\Livewire\Users\AdminUsers;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::middleware(['can:Admin sistem'])->group(function () {
    Route::get('roles/index', AdminRoles::class)->name('admin.roles.index')->middleware('can:Admin roles');
    Route::get('usuarios/index', AdminUsers::class)->name('admin.usuarios.index')->middleware('can:Admin users');
    Route::resource('/dashboard', HomeController::class)->names('admin.dashboard');
    Route::get('cursos', AdminCursos::class)->name('admin.cursos')->middleware('can:Admin users');
    Route::get('cursos/show/{curso}', CursoShow::class)->name('admin.cursos.show')->middleware('can:Admin users');
    Route::post('cursos/aprobar/{curso}', [CourseController::class, 'aprobar'])->name('admin.cursos.aprobar');
    Route::get('setings', [HomeController::class, 'setings'])->name('admin.setings');
});
