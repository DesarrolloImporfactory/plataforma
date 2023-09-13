<?php

namespace App\Http\Livewire\Intructor;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;

class IntructorCursos extends Component
{
    use WithPagination;

    protected $listeners = ['delete'];

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

    public function delete(Int $id)
    {
        try {
            Course::destroy($id);
            $this->emit('alert', 'Curso eliminado con exito!.');
        } catch (\Exception $e) {
            $this->emit('alert', $e->getMessage());
        }
    }
}
