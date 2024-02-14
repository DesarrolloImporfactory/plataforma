<?php

namespace App\Http\Livewire\Users;

use App\Models\Abono;
use App\Models\Cartera;
use App\Models\Forma;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class AlumnoCartera extends Component
{

    use WithFileUploads;

    public $cartera, $abonos;
    public $valor, $forma_pago, $file;

    protected $listeners = ['delete'];

    protected $rules = [
        'valor' => 'required|numeric',
        'forma_pago' => 'required',
        'file' => 'required'
    ];

    public function mount(Cartera $cartera)
    {
        $this->cartera = $cartera;
        $this->abonos = new Abono();
    }

    public function render()
    {
        $formas = Forma::all();
        return view('livewire.users.alumno-cartera', compact('formas'));
    }

    public function create()
    {
        $this->validate();
        try {
            if ($this->valor > $this->cartera->saldo) {
                $this->emit('alert', 'Revise el pago!');
            } else {
                $url = $this->file->store('comprobantes', 'public');
                $this->cartera->abonos()->create([
                    'valor' => $this->valor,
                    'fecha' => Carbon::now()->toDateString(),
                    'forma_id' => $this->forma_pago,
                    'archivo' => $url
                ]);
                $this->cartera = Cartera::find($this->cartera->id);
                $this->status($this->cartera);

                // reduce el saldo de la cartera
                $this->cartera->update(['saldo' => $this->cartera->saldo - $this->valor]);

                $this->reset(['valor', 'forma_pago']);
                $this->emit('estatus');
                $this->emit('alert', 'Pago registrado con exito');
            }
        } catch (\Exception $e) {
            dd('error', $e->getMessage());
        }
    }

    public function delete(Abono $lesson)
    {
        if ($lesson->archivo) {
            Storage::delete('public/' . $lesson->archivo);
        }
        Abono::destroy($lesson->id);
        $this->cartera = Cartera::find($this->cartera->id);
        $this->status($this->cartera);
        $this->emit('alert', 'Abono eliminado con exito!');
    }

    public function status(Cartera $cartera)
    {
        if ($cartera->abonos->sum('valor') == $cartera->saldo) {
            $cartera->update(['estado' => 'pagado']);
        } else {
            $cartera->update(['estado' => 'pagando']);
        }
        $this->emit('estatus');

        return true;
    }
}
