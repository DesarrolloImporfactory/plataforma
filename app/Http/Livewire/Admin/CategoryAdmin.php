<?php

namespace App\Http\Livewire\Admin;

use App\Models\Categorie;
use Livewire\Component;
use Livewire\WithPagination;


class CategoryAdmin extends Component
{
    use WithPagination;
    public $name, $idCategoria, $search = '';
    protected $listeners = ['delete'];

    public function render()
    {
        $categorias = Categorie::where('name', 'like', '%' . $this->search . '%')->orWhere('id', 'like', '%' . $this->search . '%')->paginate(10);
        return view('livewire.admin.category-admin', compact('categorias'));
    }
    public $rules = [
        'name' => 'required|string|min:2|max:20|unique:cursos.categories,name',
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
            Categorie::create([
                'name' => $this->name,
            ]);
            $this->reset(['name']);
            $this->emit('alert', 'Registro creado con exito!.');
        } catch (\Exception $e) {
            $this->emit('alert', $e->getMessage());
        }
    }
    public function show(Int $id)
    {
        try {
            $categoria = Categorie::findOrFail($id);
            $this->name = $categoria->name;
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
            Categorie::where('id', $this->idCategoria)->update([
                'name' => $this->name
            ]);
            $this->reset(['name']);
            $this->emit('alert', 'Registro update con exito!.');
        } catch (\Exception $e) {
            $this->emit('alert', $e->getMessage());
        }
    }
    public function delete(Int $id)
    {
        try {
            Categorie::destroy($id);
            $this->emit('alert', 'Registro eliminado con exito!.');
        } catch (\Exception $e) {
            $this->emit('alert', $e->getMessage());
        }
    }
}
