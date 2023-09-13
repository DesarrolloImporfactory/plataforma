<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Lesson;
use App\Models\Platform;
use App\Models\Section;
use Livewire\Component;

class CursoLeccion extends Component
{
    public $section, $lesson, $platform, $name, $url, $platform_id=1;
    protected $listeners=['delete'];

    protected $rules = [
        'lesson.name' => 'required',
        'lesson.platform_id' => 'required',
        'lesson.url' => [
            'required', 'regex:/^(https?:\/\/)?(www\.)?youtu\.be\/[A-Za-z0-9_-]+(\?[A-Za-z0-9_-]+=.*)?$/'
        ]
    ];
    public function mount(Section $section)
    {
        $this->section = $section;
        $this->lesson = new Lesson();
        $this->platform = Platform::all();
    }
    public function render()
    {
        return view('livewire.instructor.curso-leccion');
    }

    public function edit(Lesson $lesson)
    {
        $this->resetErrorBag();

        $this->lesson = $lesson;
    }

    public function update()
    {
        if ($this->lesson->platform_id == 2) {
            $this->rules['lesson.url'] = ['required', 'regex:/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/'];
        }
        $this->validate();

        $this->lesson->save();
        $this->lesson = new Lesson();
        $this->section = Section::find($this->section->id);
        $this->emit('alert', 'Lección actualizada con exito!');
    }

    public function cancel()
    {
        $this->lesson = new Lesson();
    }

    public function create()
    {
        $rules = [
            'name' => 'required',
            'platform_id' => 'required',
            'url' => [
                'required', 'regex:/^(https?:\/\/)?(www\.)?youtu\.be\/[A-Za-z0-9_-]+(\?[A-Za-z0-9_-]+=.*)?$/'
            ]
        ];
        if ($this->platform_id == 2) {
            $rules['url'] = ['required', 'regex:/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/'];
        }
        $this->validate($rules);

        Lesson::create([
            'name' => $this->name,
            'platform_id' => $this->platform_id,
            'url' => $this->url,
            'section_id' => $this->section->id
        ]);
        $this->reset(['name','platform_id','url','url']);
        $this->section = Section::find($this->section->id);
        $this->emit('alert', 'Lección creada con exito!');
    }

    public function delete($lesson){
        Lesson::destroy($lesson);
        $this->section = Section::find($this->section->id);
        $this->emit('alert', 'Lección eliminada con exito!');
    }
}
