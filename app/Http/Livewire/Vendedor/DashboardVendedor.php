<?php

namespace App\Http\Livewire\Vendedor;

use App\Models\Comision;
use Livewire\Component;

class DashboardVendedor extends Component
{
    public function render()
    {
        $comisiones = Comision::where('vendedor_id', auth()->user()->id)->paginate(5);
        $comisionSuma = Comision::where('vendedor_id', auth()->user()->id)->sum('valor');
        $pendiente = Comision::with('cartera')
            ->where('vendedor_id', auth()->user()->id)
            ->whereHas('cartera', function ($query) {
                $query->where('estado',  '!=', 'pagado');
            })
            ->count();

        $sumaVenta = Comision::where('vendedor_id', auth()->user()->id)
            ->whereHas('cartera', function ($query) {
                $query->where('estado', 'pagado');
            })
            ->with('cartera')
            ->get()
            ->sum(function ($comision) {
                return $comision->cartera->saldo;
            });
        $cobrosPendientes = Comision::where('vendedor_id', auth()->user()->id)
            ->whereHas('cartera', function ($query) {
                $query->where('estado', '!=', 'pagado');
            })
            ->with('cartera')
            ->get()
            ->sum(function ($comision) {
                return $comision->cartera->saldo;
            });




        return view('livewire.vendedor.dashboard-vendedor', compact('comisiones', 'pendiente', 'sumaVenta', 'cobrosPendientes','comisionSuma'));
    }
}
