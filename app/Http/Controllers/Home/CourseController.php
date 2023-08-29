<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function __invoke()
    {

        return view('home.course.index');
    }

    public function show(Course $curso)
    {
        $this->authorize('pubished',$curso);
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
        $curso->students()->attach(auth()->user()->id);
        return redirect()->route('cursos.view', $curso);
    }

}
