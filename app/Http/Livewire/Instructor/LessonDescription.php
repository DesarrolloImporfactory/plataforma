<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Description;
use App\Models\Lesson;
use Livewire\Component;

class LessonDescription extends Component
{
    public $lesson, $description, $name;
    protected $rules = [
        'description.name' => 'required'
    ];
    protected $listeners = ['delete'];
    public function mount(Lesson $lesson)
    {
        
        $this->lesson = $lesson;
        if ($lesson->description) {
            $this->description = $lesson->description;
        }
    }
    public function render()
    {
        return view('livewire.instructor.lesson-description');
    }
    public function update()
    {
        $this->validate();
        try {
            $this->description->save();
            $this->emit('alert', 'Descripción actualizada con exito!');
        } catch (\Exception $e) {
            $this->emit('error', $e->getMessage());
        }
    }

    public function delete()
    {
        try {
            $this->description->delete();
            $this->reset(['description', 'name']);
            $this->emit('alert', 'Descripción eliminada con exito!');
            $this->lesson = Lesson::find($this->lesson->id);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function create()
    {
        $this->validate([
            'name' => 'required'
        ]);
        try {
            $this->description = Description::create([
                'name' => $this->name,
                'lesson_id' => $this->lesson->id
            ]);
            $this->emit('alert', 'Descripción agregada con exito!');
            $this->lesson = Lesson::find($this->lesson->id);
        } catch (\Exception $e) {
            $this->emit('error', $e->getMessage());
        }
    }
}
