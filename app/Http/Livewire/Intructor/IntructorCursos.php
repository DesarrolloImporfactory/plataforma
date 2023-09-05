<?php

namespace App\Http\Livewire\Intructor;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;

class IntructorCursos extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $cursos = Course::where('title', 'like', '%' . $this->search . '%')->latest('id')->paginate(5);
        return view('livewire.intructor.intructor-cursos', compact('cursos'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
