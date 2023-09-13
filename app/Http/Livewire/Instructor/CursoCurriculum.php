<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Course;
use App\Models\Section;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CursoCurriculum extends Component
{
    use AuthorizesRequests;
    public $curso, $section, $name;
    protected $listeners = ['delete'];

    public function mount(Course $curso)
    {
        $this->curso = $curso;
        $this->section = new Section();
        $this->authorize('dictated', $curso);
    }

    protected $rules = [
        'section.name' => 'required'
    ];

    public function render()
    {
        return view('livewire.instructor.curso-curriculum')->layout('layouts.instructor');
    }

    public function edit(Section $section)
    {
        $this->section = $section;
    }

    public function update()
    {
        $this->validate();
        try {
            $this->section->save();
            $this->curso = Course::find($this->curso->id);
            $this->section = new Section();
            $this->emit('alert', 'registro actualizado!');
        } catch (\Exception $e) {
            $this->emit('error', $e->getMessage());
        }
    }

    public function create()
    {
        $this->validate([
            'name' => 'required'
        ]);
        try {
            Section::create([
                'name' => $this->name,
                'course_id' => $this->curso->id
            ]);
            $this->reset(['name']);
            $this->resetErrorBag();
            $this->curso = Course::find($this->curso->id);
            $this->emit('alert', 'Sección creada!');
        } catch (\Exception $e) {
            $this->emit('error', $e->getMessage());
        }
    }

    public function delete(Section $section)
    {
        $section->delete();
        $this->curso = Course::find($this->curso->id);
        $this->emit('alert', 'Sección eliminada!');
    }
}
