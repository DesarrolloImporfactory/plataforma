<?php

namespace App\Http\Livewire\Users;

use App\Models\Cartera;
use App\Models\Name;
use App\Models\Perfil;
use Carbon\Carbon;
use App\Models\Course;

use App\Models\Suscription;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Livewire\Livewire;

class AdminUsers extends Component
{
    public $showModal = false;
    public $selectedUserId;
    public $perfilSeleccionado;
    public $perfilId;
    public $perfil;
    public $userId;
    public $nombreUsuario;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $name, $email, $password, $idUser, $rol;
    public $sort = "id", $direction = "asc";
    protected $listeners = ['render' => 'render', 'delete', 'generarCartera' => 'generarCartera', 'asignar' => 'asignar'];

    public function render()
    {
        $perfiles = Perfil::all();
        $roles = Role::get();
        $names = Name::all();
        $usuarios = User::with(['carteras.abonos', 'suscripcions', 'perfils'])
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);

        return view('livewire.users.admin-users', compact('usuarios', 'roles', 'names', 'perfiles'))->extends('adminlte::page');
        $perfiles = Perfil::all();
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


    public function generarCartera($perfil, $userId)
    {
        $combo = Name::find($perfil);

        $cartera = Cartera::create([
            'estado' => 'pendiente',
            'fecha' => Carbon::now()->toDateString(),
            'saldo' => $combo->precio,
            'alumno_id' => $userId
        ]);
        // $suscripcion = $this->suscripcion($perfil, $userId);
        $this->emit('alert', 'Cartera y suscripcion creada exitosamente!');
    }
    public function suscripcion($perfil, $usuario)
    {
        $suscripciones = Perfil::where('name_id', $perfil)->get();
        $conteoInserciones = 0;

        foreach ($suscripciones as $suscripcion) {
            if ($suscripcion->sistemas->tipo == 'curso') {
                $curso = Course::where('title', $suscripcion->sistemas->name)->first(); // Obtener el objeto Course
                if ($curso) {
                    $curso->students()->attach(auth()->user()->id);
                }
            }
        }

        foreach ($suscripciones as $suscripcion) {
            $resultado = Suscription::create([
                'usuario_id' => $usuario,
                'sistema_id' => $suscripcion->sistema_id,
                'estado' => $suscripcion->estado,
                'fecha_fin' => $suscripcion->fecha_fin,
                'dias' =>  $suscripcion->dias
            ]);

            if ($resultado) {
                $conteoInserciones++;
            }
        }
        if ($conteoInserciones == count($suscripciones)) {
            return true;
        } else {
            return false;
        }
    }

    public function asignar($userId, $perfilId)
    {
        $client = new Client();

        $usuario = User::find($userId);
        $url = "https://registro.imporsuit.com/registro_tienda.php?premium=3&token=csie5uh4msnokqdluc2ad&correo=" . $usuario->email;
        try {
            $response = $client->request('POST', 'https://registro.imporsuit.com/api/token.php', [
                'json' => [
                    'name' => $usuario->name,
                    'whatsapp' => $usuario->telefono,
                    'email' => $usuario->email,
                    'url_tienda' => $url
                ]
            ]);

            // Obtener el cuerpo de la respuesta
            $body = $response->getBody();
            $contenido = $body->getContents();
            $datos = json_decode($contenido);

            if ($datos->error == true) {
                $this->emit('alert', "No se pudo crear el registro en tokens!");
            } else {
                User::where('id', $userId)->update([
                    'url' => $url,
                ]);
                $this->emit('alert', 'Registro creado exitosamente en tokens!');
            }
        } catch (GuzzleException $e) {
            // Manejar excepciones
            return 'Error: ' . $e->getMessage();
        }
    }
}
