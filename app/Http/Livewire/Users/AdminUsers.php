<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class AdminUsers extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $name, $email, $password, $idUser, $rol;
    public $sort = "id", $direction = "asc";
    protected $listeners = ['render' => 'render', 'delete'];

    public function render()
    {
        $roles = Role::get();
        $usuarios = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);
        return view('livewire.users.admin-users', compact('usuarios', 'roles'))->extends('adminlte::page');
    }

    protected $rules = [
        'email' => 'required|string|email|max:255|unique:users',
        'name' => 'required|string|max:255',
        'password' => 'required|string|min:8',
        'rol' => 'required',
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
                'password' => bcrypt($this->password)
            ])->assignRole($this->rol);
            $this->emit('alert', 'Registro creado exitosamente!');
            $this->emitTo('user.table-users', 'render');
        } catch (\Exception $th) {
            $this->emit('alert', $th->getMessage());
        }

        $this->reset(['name', 'email', 'password', 'rol']);
    }

    public function updateUser()
    {
        $this->validate([
            'email' => 'required|string|email|max:255',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'rol' => 'required',
        ]);
        $data = User::findOrFail($this->idUser);
        if ($this->password == $data->password) {
            $password = $data->password;
        } else {
            $password = bcrypt($this->password);
        }
        User::where('id', $this->idUser)->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $password,
        ]);
        $data->roles()->sync($this->rol);
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
        $usuario = User::with('roles')->findOrFail($idUser);

        if (count($usuario->roles) > 0) {
            foreach ($usuario->roles as $user) {
                $role = $user->id;
            }
        } else {
            $role = "";
        }

        if (isset($data)) {
            $this->idUser = $data->id;
            $this->name = $data->name;
            $this->email = $data->email;
            $this->password = $data->password;
            $this->rol = $role;
        } else {
            return redirect()->to('admin/users');
        }
    }
}
