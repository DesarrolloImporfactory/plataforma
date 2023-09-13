<?php

namespace App\Http\Livewire\Cursos;

use App\Models\Course;
use App\Models\Observation;
use Livewire\Component;

class CursoAprobar extends Component
{
    public $curso, $observaciones, $open = false;

    public function mount(Course $curso)
    {
        $this->curso = $curso;
    }
    public function render()
    {
        return view('livewire.cursos.curso-aprobar');
    }

    protected $rules = [
        'observaciones' => 'required'
    ];

    public function aprobar()
    {
        if ($this->curso->status == 3) {

            $this->emit('error', 'Este curso ya esta aprobado');
        } else {
            if (!$this->curso->lessons || !$this->curso->goal) {
                $this->emit('error', 'Este curso no puede ser publicado por esta incompleto');
            } else {
                Course::where('id', $this->curso->id)->update([
                    'status' => 3
                ]);
                $this->emit('alert', 'Curso aprobado con exito');
                return redirect()->to('admin/cursos');
            }
        }
    }

    public function observaciones()
    {
        $this->validate();
        try {
            $this->curso->observation()->create([
                'body' => $this->observaciones
            ]);
            $this->curso->status = 1;
            $this->curso->save();
            $this->open = false;
            $this->observaciones = '';
            $this->emit('alert', 'Observaciones enviadas al instructor!');
            return redirect()->to('admin/cursos');
        } catch (\Exception $e) {
            $this->emit('error', $e->getMessage());
        }
    }
}
