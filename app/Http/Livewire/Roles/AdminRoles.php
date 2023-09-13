<?php

namespace App\Http\Livewire\Roles;

use Livewire\Component;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;

class AdminRoles extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $sort = "id", $direction = "asc";
    protected $listeners = ['render' => 'render', 'delete'];
    public $idRol, $name, $permisos = [];
    public $permissions = [];

    public $rules = [
        'name' => 'required|string|min:2|max:20|unique:roles'
    ];

    public function render()
    {
        $roles = Role::where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);
        $this->permisos = Permission::all();
        return view('livewire.roles.admin-roles', compact('roles'))->extends('adminlte::page');
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function create(Request $request)
    {
        $this->validate();
        try {
            $rol = Role::create([
                'name' => $this->name,
            ]);
            $rol->permissions()->sync($this->permissions);
            $this->emit('alert', 'Registro creado exitosamente!');
            $this->emitTo('roles.table-roles', 'render');
        } catch (\Exception $e) {
            $this->emit('alert', $e->getMessage());
        }
        $this->reset(['name', 'permissions']);
    }
    public function edit(int $idRol)
    {
        $data = Role::findOrFail($idRol);
        //existen 18 permisos para admin
        $rolesWithPermissions  = $data->permissions->pluck('id');
        
        $this->permissions = $rolesWithPermissions;

        $this->idRol = $data->id;
        $this->name = $data->name;
        $this->permisos = Permission::all();
    }

    public function update()
    {

        $this->validate([
            'name' => 'required|string|min:2|max:20'
        ]);
        $data = Role::find($this->idRol);
        $permi = $this->permissions;

        $data->update(['name' => $this->name]);
        $data->permissions()->sync($permi);
        $this->emit('alert', 'Registro actualizado exitosamente!');
        $this->reset(['name', 'permissions']);
    }

    public function delete($idRol)
    {
        Role::destroy($idRol);
        $this->emit('alert', 'Registro eliminado exitosamente!');
    }
    public function order($valor)
    {
        if ($this->sort == $valor) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $valor;
            $this->direction = 'asc';
        }
    }
}
