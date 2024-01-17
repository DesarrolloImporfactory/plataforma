<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UsersConstroller;
use App\Http\Controllers\Home\CourseController;
use App\Http\Controllers\ImportController;
use App\Http\Livewire\Cursos\AdminCursos;
use App\Http\Livewire\Cursos\CursoShow;
use App\Http\Livewire\Roles\AdminRoles;
use App\Http\Livewire\Users\AdminUsers;
use App\Http\Livewire\Users\CreateUser;
use App\Http\Livewire\Users\UpdateUser;
use App\Http\Livewire\Vendedor\AdminAlumnos;
use App\Http\Livewire\Vendedor\AdminVendedores;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::middleware(['can:Admin sistem'])->group(function () {
    Route::get('roles/index', AdminRoles::class)->name('admin.roles.index')->middleware('can:Admin roles');
    Route::get('usuarios/all', AdminUsers::class)->name('admin.usuarios.all')->middleware('can:Admin users');
    Route::get('usuarios/crear', CreateUser::class)->name('admin.usuarios.crear')->middleware('can:Crud alumnos');
    Route::resource('usuarios', UsersConstroller::class,)->names('admin.usuarios')->middleware('can:Crud alumnos');
    Route::resource('/dashboard', HomeController::class)->names('admin.dashboard')->middleware('checkAdminRole');
    Route::get('cursos', AdminCursos::class)->name('admin.cursos')->middleware('can:Admin cursos');
    Route::get('cursos/show/{curso}', CursoShow::class)->name('admin.cursos.show')->middleware('can:Admin users');
    Route::post('cursos/aprobar/{curso}', [CourseController::class, 'aprobar'])->name('admin.cursos.aprobar');
    Route::get('setings', [HomeController::class, 'setings'])->name('admin.setings')->middleware('can:Admin cursos');
    Route::get('vendedores/all', AdminVendedores::class)->name('admin.vendedores.all')->middleware('can:Admin vendedores');
    Route::get('alumnos/all', AdminAlumnos::class)->name('admin.alumnos.all')->middleware('can:Gestionar alumnos');
    Route::resource('import',ImportController::class)->names('import');
});
