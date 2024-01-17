<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Models\Observation;
use Livewire\Component;

class AprobarCurso extends Component
{
    public $curso;

    public function mount(Course $curso){
        $this->curso = $curso;
    }
    public function render()
    {
        return view('livewire.aprobar-curso');
    }

    public function status()
    {
        if ($this->curso->status == 1) {
            $this->curso->status = 2;
            $this->curso->save();
            Observation::where('course_id', $this->curso->id)->delete();
            // $curso->observation->delete();
            $this->emit('error', 'Curso enviado a revisión con exito!');
        } else {
            $this->emit('error', 'El curso ya se encuentra en el estado deseado.');
        }
    }
}
