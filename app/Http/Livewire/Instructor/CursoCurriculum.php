<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Course;
use App\Models\Lesson;
use Livewire\Component;

class CursoCurriculum extends Component
{

    public $curso,$lesson;

    public function mount(Course $curso){
        $this->curso = $curso;
        $this->lesson = new Lesson();
    }

    public function render()
    {
        return view('livewire.instructor.curso-curriculum')->layout('layouts.instructor');
    }

    public function edit(Lesson $lesson){
        $this->lesson = $lesson;
    }
}
