<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Course;
use App\Models\Requirement;
use Livewire\Component;

class CursoRequerimientos extends Component
{
    public $curso, $requirement, $name;

    protected $listeners = ['delete'];

    protected $rules = [
        'requirement.name' => 'required'
    ];

    public function mount(Course $curso)
    {
        $this->curso = $curso;
        $this->requirement = new Requirement();
    }

    public function render()
    {
        return view('livewire.instructor.curso-requerimientos');
    }

    public function edit(Requirement $requirement)
    {
        $this->requirement = $requirement;
    }

    public function update()
    {
        try {
            $this->validate();
            $this->requirement->save();
            $this->requirement = new Requirement();
            $this->curso = Course::find($this->curso->id);
            $this->emit('alert', 'Requisito actualizado exitosamente!');
        } catch (\Exception $e) {
            $this->emit('error', $e->getMessage());
        }
    }

    public function delete(Requirement $requirement)
    {
        try {
            $requirement->delete();
            $this->curso = Course::find($this->curso->id);
            $this->emit('alert', 'Requisito eliminado!');
        } catch (\Exception $e) {
            $this->emit('error', $e->getMessage());
        }
    }
    public function store()
    {
        $this->validate([
            'name' => 'required'
        ]);
        $this->curso->requirement()->create([
            'name' => $this->name
        ]);
        $this->reset(['name']);
        $this->curso = Course::find($this->curso->id);
        $this->emit('alert', 'Requisito creado!');
    }
}
