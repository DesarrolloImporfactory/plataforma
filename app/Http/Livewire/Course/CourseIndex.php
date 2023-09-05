<?php

namespace App\Http\Livewire\Course;

use App\Models\Categorie;
use App\Models\Course;
use App\Models\Level;
use Livewire\Component;
use Livewire\WithPagination;

class CourseIndex extends Component
{
    use WithPagination;

    public $categorie_id, $level_id;

    public function render()
    {
        $levels = Level::all();
        $categories = Categorie::all();
        $cursos = Course::where('status', 3)
            ->categorie($this->categorie_id)->level($this->level_id)
            ->latest('id')->paginate(8);
        return view('livewire.course.course-index', compact('cursos', 'levels', 'categories'));
    }

    public function resetFilters()
    {
        $this->reset(['categorie_id', 'level_id']);
    }
}
