<?php

namespace App\Http\Livewire\Instructor;

use App\Models\Lesson;
use App\Models\Resource;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class LessonResources extends Component
{

    use WithFileUploads;

    public $lesson;
    public $file;
    protected $listeners = ['eliminar'];
    public function mount(Lesson $lesson)
    {
        $this->lesson = $lesson;
    }
    public function render()
    {
        return view('livewire.instructor.lesson-resources');
    }

    public function save()
    {
        $this->validate([
            'file' => 'required', // 1MB Max
        ]);

        $file = $this->file->store('files', 'public');

        $this->lesson->resource()->create([
            'url' => $file
        ]);

        $this->lesson = Lesson::find($this->lesson->id);
        $this->emit('alert', 'Recurso guardado con exito!');
    }

    public function download()
    {
        //descarga un archivo con livewire
        return response()->download(storage_path('app/public/' . $this->lesson->resource->url));
    }

    public function eliminar($recurso)
    {
        
        $url = ($recurso['url']);
        Storage::delete('public/'.$url);
        Resource::where('url',$url)->delete();
        $this->emit('alert', 'Recurso eliminado con exito!');
        $this->lesson = Lesson::find($this->lesson->id);
    }
}
