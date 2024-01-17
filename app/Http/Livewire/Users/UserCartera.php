<?php

namespace App\Http\Livewire\Users;

use App\Models\Cartera;
use App\Models\Comision;
use App\Models\Forma;
use App\Models\TipoComision;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class UserCartera extends Component
{
    public $user, $exist = 'false', $cartera, $comision, $valor, $editar = 'false';
    public $vendedor, $comision_tipo, $comision_id, $tiposComision = '0';
    public $detalle, $cart;
    protected $listeners = ['destroy'];

    public function mount(User $user)
    {
        $this->user = $user;
        if ($this->user->carteras) {
            $this->cartera = Cartera::where('alumno_id', $this->user->id)->get();
            $this->cart = Cartera::where('alumno_id', $this->user->id)->first();
            //esto va dentro del componente de cartera
            if ($this->cart->comision) {
                $this->exist = 'true';
                $this->comision = Comision::where('cartera_id', $this->cart->id)->first();
            }
        }
    }

    public function render()
    {
        $formas = Forma::all();
        $comisiones = TipoComision::where('vendedor_id', auth()->user()->id)->get();

        $vendedores = User::whereHas("roles", function ($q) {
            $q->where("name", "Vendedor");
        })->get();

        return view('livewire.users.user-cartera', compact('formas', 'comisiones', 'vendedores'));
    }

    protected $rules = [
        'vendedor' => 'required',
        'comision_tipo' => 'required',
    ];

    public function getComision()
    {
        $this->tiposComision = TipoComision::where('vendedor_id', $this->vendedor)->get();
    }

    public function save()
    {
        $cartera = Cartera::where('alumno_id', $this->user->id)->first();

        $this->validate([
            'valor' => 'required',
            'detalle' => 'required'
        ]);
        try {
            $deuda = Cartera::create([
                'estado' => 'pendiente',
                'fecha' => Carbon::now()->toDateString(),
                'saldo' => $this->valor,
                'detalle' => $this->detalle,
                'alumno_id' => $this->user->id
            ]);
            if ($cartera->comision) {
                Comision::create([
                    'vendedor_id' => $cartera->comision->vendedor_id,
                    'cartera_id' => $deuda->id,
                    'tipo_id' => $cartera->comision->tipo_id
                ]);
            }
            $this->cartera = Cartera::where('alumno_id', $this->user->id)->get();
            $this->reset(['valor', 'detalle']);
            $this->emit('alert', 'Deuda asignado con exito!');
        } catch (\Exception $e) {
            dd('error', $e->getMessage());
        }
    }

    public function create()
    {

        $this->validate();
        try {
            foreach ($this->cartera as $item) {
                $comision = Comision::create([
                    'vendedor_id' => $this->vendedor,
                    'cartera_id' => $item->id,
                    'tipo_id' => $this->comision_tipo
                ]);
            }

            $this->comision = Comision::where('id', $comision->id)->first();
            $this->exist = 'true';
            $this->emit('alert', 'Comisionista asignadocon exito!');
        } catch (\Exception $e) {
            dd('error', $e->getMessage());
        }
    }

    public function createComision()
    {
        $this->validate([
            'comision_id' => 'required'
        ]);
        try {
            $comision = Comision::create([
                'vendedor_id' => auth()->user()->id,
                'cartera_id' => $this->cartera->id,
                'tipo_id' => $this->comision_id
            ]);
            $this->comision = Comision::where('id', $comision->id)->first();
            $this->exist = 'true';
            $this->emit('alert', 'Comisionista asignadocon exito!');
        } catch (\Exception $e) {
            dd('error', $e->getMessage());
        }
    }

    public function show(Comision $comision)
    {
        $this->editar = 'true';
        $this->vendedor = $comision->vendedor_id;
        $this->comision_tipo = $comision->tipos->id;
        $this->comision_id = $comision->tipos->id;
        $this->valor = $comision->tipos->valor;
    }

    public function update()
    {
        $this->validate();
        try {
            $carteras = Cartera::where('alumno_id', $this->user->id)->get();
            foreach ($carteras as $item) {
                Comision::where('cartera_id', $item->id)->update([
                    'vendedor_id' => $this->vendedor,
                    'tipo_id' => $this->comision_tipo,
                ]);
                if ($item->estado == 'pagado') {
                    Comision::where('cartera_id',$item->id)->update([
                        'valor' => $item->saldo * ($this->valor / 100)
                    ]);
                }
            }
            $this->comision = Comision::where('cartera_id', $this->cart->id)->first();
            $this->editar = 'false';
            $this->emit('alert', 'Comisionista actualizado exito!');
        } catch (\Exception $e) {
            dd('error', $e->getMessage());
        }
    }

    public function updateComision()
    {
        $this->validate([
            'comision_id' => 'required'
        ]);
        try {
            Comision::where('cartera_id', $this->cartera->id)->update([
                'tipo_id' => $this->comision_id,
            ]);
            if ($this->cartera->estado == 'pagado') {
                Comision::where('cartera_id', $this->cartera->id)->update([
                    'valor' => $this->cartera->saldo * ($this->cartera->tipos->valor / 100)
                ]);
            }
            $this->comision = Comision::where('cartera_id', $this->cartera->id)->first();
            $this->editar = 'false';
            $this->emit('alert', 'Comisionista actualizado exito!');
        } catch (\Exception $e) {
            dd('error', $e->getMessage());
        }
    }

    public function destroy($cartera){
        Cartera::destroy($cartera);
        $this->cartera = Cartera::where('alumno_id', $this->user->id)->get();
            $this->cart = Cartera::where('alumno_id', $this->user->id)->first();
    }
}
