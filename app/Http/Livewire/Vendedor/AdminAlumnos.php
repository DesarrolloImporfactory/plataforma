<?php

namespace App\Http\Livewire\Vendedor;

use App\Models\Comision;
use Livewire\Component;
use Livewire\WithPagination;

class AdminAlumnos extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';

    public function render()
    {
        $comisiones = Comision::with('vendedor')
        ->whereHas('vendedor', function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })->where('vendedor_id', auth()->user()->id)->paginate(5);
        // $comisiones = Comision::where('valor', 'like', '%' . $this->search . '%')->where('vendedor_id', auth()->user()->id)->paginate(5);
        return view('livewire.vendedor.admin-alumnos',compact('comisiones'))->extends('adminlte::page');
    }
}
