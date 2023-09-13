<?php

namespace App\Http\Livewire\Cursos;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCursos extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $sort = "id", $direction = "asc";

    public function render()
    {
        $cursos = Course::where('title', 'like', '%' . $this->search . '%')->where('status',2)->orderBy($this->sort, $this->direction)->paginate(10);
        return view('livewire.cursos.admin-cursos', compact('cursos'))->extends('adminlte::page');;
    }

    public function order($valor)
    {
        if ($this->sort == $valor) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $valor;
            $this->direction = 'asc';
        }
    }
}
