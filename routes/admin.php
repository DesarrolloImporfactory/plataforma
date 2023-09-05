<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Livewire\Roles\AdminRoles;
use App\Http\Livewire\Users\AdminUsers;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::middleware(['can:Admin sistem'])->group(function () {
    Route::get('roles/index', AdminRoles::class)->name('admin.roles.index')->middleware('can:Admin roles');
    Route::get('usuarios/index', AdminUsers::class)->name('admin.usuarios.index')->middleware('can:Admin users');
    Route::resource('/dashboard', HomeController::class)->names('admin.dashboard');
});
