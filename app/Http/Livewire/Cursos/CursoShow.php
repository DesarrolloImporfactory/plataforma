<?php

namespace App\Http\Livewire\Cursos;

use App\Models\Course;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CursoShow extends Component
{
    use AuthorizesRequests;

    public $curso;

    public function mount(Course $curso)
    {
        $this->authorize('aprobar',$curso);
        $this->curso = $curso;
    }

    public function render()
    {
        return view('livewire.cursos.curso-show');
    }
}
