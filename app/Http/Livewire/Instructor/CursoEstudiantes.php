<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CursoEstudiantes extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    public $curso, $search;
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function mount(Course $curso)
    {
        $this->curso = $curso;
        $this->authorize('dictated', $curso);
    }

    public function render()
    {
        $estudiantes = $this->curso->students()->where('name', 'like', '%' . $this->search . '%')->paginate(4);
        return view('livewire.instructor.curso-estudiantes', compact('estudiantes'))->layout('layouts.instructor');
    }
}
