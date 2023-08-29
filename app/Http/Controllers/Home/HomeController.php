<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
    
        $cursos = Course::where('status',3)->latest('id')->take(12)->get();
        return view('home.home.index',compact('cursos'));
    }
}
