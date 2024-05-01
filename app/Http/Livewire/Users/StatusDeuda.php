<?php

namespace App\Http\Livewire\Users;

use App\Models\Cartera;
use Livewire\Component;

class StatusDeuda extends Component
{
    public $deuda;
    public $listeners = ['estatus' => 'render'];

    public function mount(Cartera $deuda)
    {
        $this->deuda = $deuda;
    }

    public function render()
    {
        $totalDeuda = $this->deuda->saldo;
        if ($totalDeuda == 0) {
            $abonos = $this->deuda->abonos->sum('valor');
            $porcentaje = 0;
        }else{
            $abonos = $this->deuda->abonos->sum('valor');
            $porcentaje = ($abonos / $totalDeuda) * 100;
        }
        
        return view('livewire.users.status-deuda', compact('totalDeuda', 'abonos', 'porcentaje'));
    }
}
