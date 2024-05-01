<?php

namespace App\Http\Livewire\Vendedor;

use App\Models\Tipo;
use App\Models\TipoComision;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class AdminVendedores extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $name, $email, $password, $idUser, $rol, $comisionesTipo = '0', $comision, $valor;
    public $sort = "id", $direction = "asc";
    protected $listeners = ['render' => 'render', 'delete'];


    public function render()
    {
        $roles = Role::get();

        $usuarios = User::where('name', 'like', '%' . $this->search . '%')->orderBy($this->sort, $this->direction)
            ->whereHas("roles", function ($q) {
                $q->where("name", "Vendedor");
            })->paginate(10);

        return view('livewire.vendedor.admin-vendedores', compact('usuarios', 'roles'))->extends('adminlte::page');
    }

    protected $rules = [
        'email' => 'required|string|email|max:255|unique:users',
        'name' => 'required|string|max:255',
        'password' => 'required|string|min:8',
    ];

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

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function createUser()
    {
        $this->validate();
        try {
            $usuario = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' =>  Hash::make($this->password),
            ])->assignRole('Vendedor');
            $this->emit('alert', 'Registro creado exitosamente!');
            $this->emitTo('user.table-users', 'render');
        } catch (\Exception $th) {
            dd('alert', $th->getMessage());
        }

        $this->reset(['name', 'email', 'password', 'rol']);
    }

    public function updateUser()
    {
        $this->validate([
            'email' => 'required|string|email|max:255',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);
        $data = User::findOrFail($this->idUser);
        if ($this->password == $data->password) {
            $password = $data->password;
        } else {
            $password = Hash::make($this->password);
        }
        User::where('id', $this->idUser)->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $password,
        ]);
        $this->emit('alert', 'Registro actualizado exitosamente!');
        // $this->emit('render');
        $this->reset(['name', 'email', 'password']);
    }

    public function delete($idUser)
    {
        User::destroy($idUser);
        $this->emit('alert', 'Registro eliminado exitosamente!');
    }

    public function editUser(int $idUser)
    {
        $data = User::findOrFail($idUser);

        $this->idUser = $data->id;
        $this->name = $data->name;
        $this->email = $data->email;
        $this->password = $data->password;
    }

    public function comisiones(int $idUser)
    {
        $data = TipoComision::where('vendedor_id', $idUser)->get();

        $this->idUser = User::find($idUser);
        if (count($data) > 0) {
            $this->comisionesTipo = $data;
        } else {
            $this->comisionesTipo = '0';
        }
    }
    public function createComision()
    {
        $this->validate([
            'comision' => 'required',
            'valor' => 'required|numeric'
        ]);
        $this->idUser->tipos()->create([
            'name' => $this->comision,
            'valor' => $this->valor
        ]);
        $data = TipoComision::where('vendedor_id', $this->idUser->id)->get();
        $this->comisionesTipo = $data;
        $this->emit('alert', 'Registro creado exitosamente!');
    }

    public function trash($idUser)
    {
        TipoComision::destroy($idUser);
        $this->emit('alert', 'Registro eliminado exitosamente!');
        $data = TipoComision::where('vendedor_id', $this->idUser->id)->get();
        $this->comisionesTipo = $data;
    }
}