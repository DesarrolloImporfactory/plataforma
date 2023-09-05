<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Course;
use App\Models\Level;
use App\Models\Price;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function index()
    {
        //
    }


    public function create()
    {
        
        return view('home.instructor.create');
    }


    public function store(Request $request)
    {
        //
    }


    public function show($curso)
    {
        
        // $curso = Course::findOrFail($curso);
        return view('home.instructor.show', compact('curso'));
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
