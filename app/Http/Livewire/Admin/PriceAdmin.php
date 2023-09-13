<?php

namespace App\Http\Livewire\Admin;

use App\Models\Price;
use Livewire\Component;
use Livewire\WithPagination;

class PriceAdmin extends Component
{
    use WithPagination;
    public $name,$value, $idCategoria, $search = '';
    protected $listeners = ['delete'];

    public function render()
    {
        $precios = Price::where('name', 'like', '%' . $this->search . '%')->orWhere('id', 'like', '%' . $this->search . '%')->paginate(10);
        return view('livewire.admin.price-admin',compact('precios'));
    }
    public $rules = [
        'name' => 'required|string|min:2|max:20|unique:cursos.prices,name',
        'value' => 'required|numeric'
    ];
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function create()
    {
        $this->validate();
        try {
            Price::create([
                'name' => $this->name,
                'value' => $this->value,
            ]);
            $this->reset(['name','value']);
            $this->emit('alert', 'Registro creado con exito!.');
        } catch (\Exception $e) {
            $this->emit('alert', $e->getMessage());
        }
    }
    public function show(Int $id)
    {
        try {
            $categoria = Price::findOrFail($id);
            $this->name = $categoria->name;
            $this->value = $categoria->value;
            $this->idCategoria = $categoria->id;
        } catch (\Exception $e) {
            $this->emit('alert', $e->getMessage());
        }
    }
    public function update()
    {
        $this->validate([
            'name' => 'required|string|min:2|max:20',
        ]);
        try {
            Price::where('id', $this->idCategoria)->update([
                'name' => $this->name,
                'value' =>$this->value
            ]);
            $this->reset(['name','value']);
            $this->emit('alert', 'Registro update con exito!.');
        } catch (\Exception $e) {
            $this->emit('alert', $e->getMessage());
        }
    }
    public function delete(Int $id)
    {
        try {
            Price::destroy($id);
            $this->emit('alert', 'Registro eliminado con exito!.');
        } catch (\Exception $e) {
            $this->emit('alert', $e->getMessage());
        }
    }
}
