<?php

namespace App\Http\Livewire\Users;

use App\Models\Abono;
use App\Models\Cartera;
use App\Models\Forma;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class PagosCartera extends Component
{
    use WithFileUploads;

    public $abono;
    public $editar = 'false';
    protected $listeners = ['abonos' => 'render'];
    public $valor, $forma_pago, $file;


    public function mount(Abono $abono)
    {
        $this->abono = $abono;
        $this->valor = $this->abono->valor;
        $this->forma_pago = $this->abono->forma_id;
    }

    protected $rules = [
        'valor' => 'required|numeric',
        'forma_pago' => 'required',
    ];

    public function render()
    {
        $formas = Forma::all();
        return view('livewire.users.pagos-cartera', compact('formas'));
    }

    public function editar(Abono $abono)
    {
        $this->abono = $abono;
        $this->valor = $this->abonos->valor;
        $this->forma_pago = $this->abonos->forma_id;
    }

    public function update()
    {
        $this->validate();
        try {
            if ($this->valor > $this->abono->cartera->saldo || ((($this->abono->sum('valor') - $this->abono->valor) + $this->valor) > $this->abono->cartera->saldo)) {
                $this->emit('alert', 'Revise el pago!');
            } else {
                if ($this->file) {
                    $file = $this->file->store('comprobantes', 'public');
                    if ($this->abono->archivo) {
                        Storage::delete('public/' . $this->abono->archivo);
                    }
                    $this->abono->update([
                        'valor' => $this->valor,
                        'fecha' => Carbon::now()->toDateString(),
                        'forma_id' => $this->forma_pago,
                        'archivo' => $file
                    ]);
                } else {
                    $this->abono->update([
                        'valor' => $this->valor,
                        'fecha' => Carbon::now()->toDateString(),
                        'forma_id' => $this->forma_pago,
                    ]);
                }
                $this->emit('alert', 'Pago actualizado con exito!');
            }
            // $this->abono = Abono::find($this->abono->id);
            $this->status($this->abono->cartera_id);
            $this->editar = 'false';
            
        } catch (\Exception $e) {
            dd('alert', $e->getMessage());
        }
    }

    public function status($id)
    {
        $cartera = Cartera::find($id);
        if ($cartera->abonos->sum('valor') == $cartera->saldo) {
            $cartera->update(['estado' => 'pagado']);
        } else {
            $cartera->update(['estado' => 'pagando']);
        }
        $this->emit('estatus');

        return true;
    }
}
