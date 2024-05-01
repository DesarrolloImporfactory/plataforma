<?php

namespace App\Observers;

use App\Models\Abono;
use App\Models\Cartera;
use App\Models\Comision;

class AbonoObserver
{

    public function created(Abono $abono)
    {
       
        $deuda = $abono->cartera->saldo;
        $id = $abono->cartera->id;
        $pagos = Abono::where('cartera_id',$id)->sum('valor');
        $comision = Comision::where('cartera_id', $id)->first();
        if ($comision && $pagos == $deuda) {

            $comision->update([
                'valor' => ($comision->tipos->valor / 100) * $deuda
            ]);
        }
    }


    public function updated(Abono $abono)
    {
        $pagos = $abono->sum('valor');
        $deuda = $abono->cartera->saldo;
        $id = $abono->cartera->id;
        $comision = Comision::where('cartera_id', $id)->first();
        if ($comision) {

            if ($pagos == $deuda) {
                $comision->update([
                    'valor' => ($comision->tipos->valor / 100) * $deuda
                ]);
            } else {
                $comision->update([
                    'valor' => 0
                ]);
            }
        }
    }


    public function deleted(Abono $abono)
    {

        $id = $abono->cartera->id;
        $comision = Comision::where('cartera_id', $id)->first();
        if ($comision) {
            $comision->update([
                'valor' => 0
            ]);
        }
    }


    public function restored(Abono $abono)
    {
        //
    }

    public function forceDeleted(Abono $abono)
    {
        //
    }
}
