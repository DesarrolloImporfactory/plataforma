<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

   
    public function __construct()
    {
        //
    }

    public function matriculado(User $user, Course $curso){
        //comprueba si el usuario existe en la relacion curso - estudiantes
        return $curso->students->contains($user->id);
    }

    public function pubished(?User $user, Course $curso){
        if ($curso->status == 3) {
            return true;
        } else {
            return false;
        }
        
    }
}
