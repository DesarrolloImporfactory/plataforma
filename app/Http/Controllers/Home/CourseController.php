<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Observation;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function __invoke()
    {

        return view('home.course.index');
    }

    public function show(Course $curso)
    {
        $this->authorize('pubished', $curso);
        try {
            $similares = Course::where('categorie_id', $curso->categorie_id)->where('id', '!=', $curso->id)
                ->where('status', '3')->latest('id')->take(5)->get();
            return view('home.course.show', compact('curso', 'similares'));
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function matricular(Course $curso)
    {
        if (!$curso->students->contains(auth()->user()->id)) {
            $curso->students()->attach(auth()->user()->id);
        }

        return redirect()->route('cursos.view', $curso);
    }

    public function metas(Course $curso)
    {
        $this->authorize('dictated', $curso);
        return view('home.instructor.metas', compact('curso'));
    }

    public function estatus(Course $curso)
    {
        if ($curso->status == 1) {
            $curso->status = 2;
            $curso->save();
            Observation::where('course_id', $curso->id)->delete();
            // $curso->observation->delete();
            return redirect()->route('instructor.cursos.admin', $curso)->with('message', 'El curso se ha enviado para revisión exitosamente.');
        } else {
            return back()->with('message', 'El curso ya se encuentra en el estado deseado.');
        }
    }

    public function observaciones(Course $curso)
    {
        if ($curso->observation) {
            return view('home.instructor.observaciones', compact('curso'));
        } else {
            return back()->with('message', 'Este curso no tiene observaciones');
        }
    }
}
