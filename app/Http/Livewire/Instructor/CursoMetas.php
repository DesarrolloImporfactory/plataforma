<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Course;
use App\Models\Goal;
use Livewire\Component;

class CursoMetas extends Component
{
    public $curso, $goal, $name;

    protected $listeners = ['delete'];

    protected $rules = [
        'goal.name' => 'required'
    ];

    public function mount(Course $curso)
    {
        $this->curso = $curso;
        $this->goal = new Goal();
    }
    public function render()
    {
        return view('livewire.instructor.curso-metas');
    }

    public function edit(Goal $goal)
    {
        $this->goal = $goal;
    }

    public function update()
    {
        try {
            $this->validate();
            $this->goal->save();
            $this->goal = new Goal();
            $this->curso = Course::find($this->curso->id);
            $this->emit('alert', 'Meta actualizada exitosamente!');
        } catch (\Exception $e) {
            $this->emit('error', $e->getMessage());
        }
    }

    public function delete(Goal $goal)
    {
        try {
            $goal->delete();
            $this->curso = Course::find($this->curso->id);
            $this->emit('alert', 'Meta eliminada!');
        } catch (\Exception $e) {
            $this->emit('error', $e->getMessage());
        }
    }
    public function store()
    {
        $this->validate([
            'name' => 'required'
        ]);
        $this->curso->goal()->create([
            'name' => $this->name
        ]);
        $this->reset(['name']);
        $this->curso = Course::find($this->curso->id);
        $this->emit('alert', 'Meta creada!');
    }
}
