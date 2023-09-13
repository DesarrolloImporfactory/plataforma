<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Audience;
use App\Models\Course;
use Livewire\Component;

class CursoAudiencia extends Component
{
    public $curso, $audience, $name;

    protected $listeners = ['delete'];

    protected $rules = [
        'audience.name' => 'required'
    ];

    public function mount(Course $curso)
    {
        $this->curso = $curso;
        $this->audience = new Audience();
    }

    public function render()
    {
        return view('livewire.instructor.curso-audiencia');
    }


    public function edit(Audience $audience)
    {
        $this->audience = $audience;
    }

    public function update()
    {
        try {
            $this->validate();
            $this->audience->save();
            $this->audience = new Audience();
            $this->curso = Course::find($this->curso->id);
            $this->emit('alert', 'Audiencia actualizada exitosamente!');
        } catch (\Exception $e) {
            $this->emit('error', $e->getMessage());
        }
    }

    public function delete(Audience $audience)
    {
        try {
            $audience->delete();
            $this->curso = Course::find($this->curso->id);
            $this->emit('alert', 'Audiencia eliminada!');
        } catch (\Exception $e) {
            $this->emit('error', $e->getMessage());
        }
    }
    public function store()
    {
        $this->validate([
            'name' => 'required'
        ]);
        $this->curso->audience()->create([
            'name' => $this->name
        ]);
        $this->reset(['name']);
        $this->curso = Course::find($this->curso->id);
        $this->emit('alert', 'Audiencia creada!');
    }
}
