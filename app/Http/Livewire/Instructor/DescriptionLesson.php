<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Course;
use App\Models\Enlace;
use App\Models\Lesson;
use Livewire\Component;

class DescriptionLesson extends Component
{
    public $lesson, $enlaces, $name,$url;

    protected $listeners = ['delete'];


    protected $rules = [
        'enlaces.name' => 'required',
        'enlaces.url' => 'required'
    ];

    public function mount(Lesson $lesson){
        $this->lesson = $lesson;
        $this->enlaces = new Enlace();
    }
    public function render()
    {
        return view('livewire.instructor.description-lesson');
    }

    public function edit(Enlace $enlaces)
    {
        $this->enlaces = $enlaces;
    }
    public function update()
    {
        try {
            $this->validate();
            $this->enlaces->save();
            $this->enlaces = new Enlace();
            $this->lesson = Lesson::find($this->lesson->id);
            $this->emit('alert', 'Enlace actualizada exitosamente!');
        } catch (\Exception $e) {
            $this->emit('error', $e->getMessage());
        }
    }

    public function delete($enlaces)
    {
        try {
            Enlace::destroy($enlaces);
            $this->lesson = Lesson::find($this->lesson->id);
            $this->emit('alert', 'Enlace eliminada!');
        } catch (\Exception $e) {
            $this->emit('error', $e->getMessage());
        }
    }
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'url' => 'required',
        ]);
        $this->lesson->enlaces()->create([
            'name' => $this->name,
            'url' => $this->url
        ]);
        $this->reset(['name','url']);
        $this->lesson = Lesson::find($this->lesson->id);
        $this->emit('alert', 'Enlace creada!');
    }
}
