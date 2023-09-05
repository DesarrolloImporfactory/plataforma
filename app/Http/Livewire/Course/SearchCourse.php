<?php

namespace App\Http\Livewire\Course;

use App\Models\Course;
use Livewire\Component;

class SearchCourse extends Component
{
    public $search = '';
    public function render()
    {
        return view('livewire.course.search-course');
    }
    //PROPIEDAD COMPUTADA 
    public function getResultProperty()
    {
        return Course::where('title', 'like', '%' . $this->search . '%')->where('status', 3)->take(8)->get();
    }
}
