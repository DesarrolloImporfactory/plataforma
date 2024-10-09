<?php

use App\Http\Controllers\Home\CourseController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\RedirectController;
use App\Http\Livewire\Course\StatusCourse;
use App\Http\Livewire\Vendedor\DashboardVendedor;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;



Route::group(['middleware' => ['auth.jwt']], function () {
    Route::get('/newlogin', function () {
        return  "newlogin";
    })->name('newlogin');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/', CourseController::class)->name('home');

    Route::get('/cursos/index', CourseController::class)->name('cursos.index');

    Route::get('/cursos/show/{curso}', [CourseController::class, 'show'])->name('cursos.show');

    Route::post('/cursos/enrolled/{curso}', [CourseController::class, 'matricular'])->name('cursos.enrolled');

    Route::get('/cursos/view/{curso}', StatusCourse::class)->name('cursos.view');

    Route::get('/vendedor', DashboardVendedor::class)->name('vendedor')->middleware('can:Dashboard vendedor');
});

Route::get('admin/redirect/{id}', [RedirectController::class, 'redirectUser'])->name('admin.redirect');
