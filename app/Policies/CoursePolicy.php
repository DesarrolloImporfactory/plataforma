<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\Review;
use App\Models\Sistema;
use App\Models\User;
use App\Models\Suscription;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;


    public function __construct()
    {
        //
    }

    public function matriculado(User $user, Course $curso)
    {
        $rol = $user->roles->first();
        if ($curso->students->contains($user->id) || $rol->name == 'Admin' || $rol->name == 'Especialista') {
            return true;
        } else {
            return false;
        }
        //comprueba si el usuario existe en la relacion curso - estudiantes

    }

    public function pubished(?User $user, Course $curso)
    {
        if ($curso->status == 3) {
            return true;
        } else {
            return false;
        }
    }

    public function dictated(User $user, Course $curso)
    {
        if ($curso->user_id == $user->id) {
            return true;
        } else {
            return false;
        }
    }

    public function aprobar(User $user, Course $curso)
    {
        if ($curso->status == 2) {
            return true;
        } else {
            return false;
        }
    }

    public function valued(User $user, Course $curso)
    {
        if (Review::where('user_id', $user->id)->where('course_id', $curso->id)->count()) {
            return false;
        } else {
            return true;
        }
    }

    public function userCourse(User $user, Course $curso)
    {
        $sistema = Sistema::where('name', $curso->title)->first();
        $rol = $user->roles->first();

        if (isset($sistema)) {
            $usuariosConSuscripcionesActivas = Suscription::where('estado', 'Activa')
                ->where('usuario_id', $user->id)
                ->where('sistema_id', $sistema->id)->first();
            if ($usuariosConSuscripcionesActivas || $rol->name == 'Admin' || $rol->name == 'Especialista') {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
