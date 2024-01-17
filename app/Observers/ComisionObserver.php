<?php

namespace App\Observers;

use App\Models\Comision;

class ComisionObserver
{
    
    public function created(Comision $comision)
    {
        if($comision->cartera->estado == 'pagado'){
            $comision->update([
                'valor' =>$comision->cartera->saldo * ($comision->tipos->valor/100)
            ]);
        }
    }

    
    public function updated(Comision $comision)
    {
        //
    }

 
    public function deleted(Comision $comision)
    {
        //
    }

  
    public function restored(Comision $comision)
    {
        //
    }

   
    public function forceDeleted(Comision $comision)
    {
        //
    }
}
