<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\Review;
use App\Models\User;
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
        //comprueba si el usuario existe en la relacion curso - estudiantes
        return $curso->students->contains($user->id);
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

    public function valued(User $user, Course $curso){
        if (Review::where('user_id',$user->id)->where('course_id',$curso->id)->count()) {
            return false;
        } else {
            return true;
        }
    }
}
