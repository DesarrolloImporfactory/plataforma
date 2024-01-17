<?php

namespace App\Http\Livewire\Users;

use App\Models\Perfil;
use App\Models\Suscription;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use GuzzleHttp\Client;

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
            ->whereHas("roles", function ($q) {
                $q->where("name", "Alumno");
            })->paginate(10);
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
                'password' => md5($this->password)
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
            $password = md5($this->password);
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

    public function suscripcion()
    {
        // $users = User::where('id', '>', '11067')->get();
        // foreach ($users as $user) {
        //     $suscripciones = Perfil::where('name_id', $user->perfil_id)->get();

        //     foreach ($suscripciones as $suscripcion) {
        //         Suscription::create([
        //             'usuario_id' => $user->id,
        //             'sistema_id' => $suscripcion->sistema_id,
        //             'estado' => $suscripcion->estado,
        //             'fecha_fin' => $suscripcion->fecha_fin,
        //             'dias' =>  $suscripcion->dias
        //         ]);
        //     }
        // }
        $response = Http::withHeaders([
            'wolkvox-token' => '7b69645f6469737472697d2d3230323331303330313530313435',
            'Content-Type' => 'application/json',
        ])->post('https://wv0100.wolkvox.com/api/v2/whatsapp.php?api=send_template_official', [
            "connector_id" => "1947",
            "telephone" => "593963607750",
            "template_name" => "comprobacion",
            "template_vars" => "hola;hola;hola;hola",
            "customer_id" => "",
            "url_attach" => "",
        ]);

        // Obtener la respuesta
        $responseBody = $response->body();
        $this->emit('enviar-mensaje', $responseBody);
    }
}
