<?php

namespace App\Http\Livewire\Users;

use App\Models\Cartera;
use App\Models\Comision;
use App\Models\Course;
use App\Models\Name;
use App\Models\Perfil;
use App\Models\Suscription;
use Livewire\Component;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegisteredMail;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;


class CreateUser extends Component
{

    public $email, $name, $enlace, $password, $rol, $url, $perfil, $telefono, $url_tienda;

    protected $rules = [
        'email' => 'required|string|email|max:255|unique:users',
        'name' => 'required|string|max:255',
        'password' => 'required|string|min:8',
        'url' => 'nullable|url',
        'perfil' => 'required',
        'telefono' => 'required',
        'enlace' => 'nullable|url'
    ];

    protected $listeners = ['urlTiedaUpdated'];

    public function urlTiedaUpdated($url)
    {
        $this->url_tienda = $url;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function enviarDatosExternos($usuario)
    {
        $client = new Client();

        try {
            $response = $client->request('POST', 'https://registro.imporsuit.com/api/token.php', [
                'json' => [
                    'name' => $usuario->name,
                    'whatsapp' => $usuario->telefono,
                    'email' => $usuario->email,
                    'url_tienda' => $usuario->url,
                ]
            ]);

            // Obtener el cuerpo de la respuesta
            $body = $response->getBody();
            $contenido = $body->getContents();
            $datos = json_decode($contenido);

            if ($datos->error == true) {
                $this->emit('alert', "No se pudo crear el registro en tokens!");
            } else {
                $this->emit('alert', 'Registro creado exitosamente en tokens!');
            }
        } catch (GuzzleException $e) {
            // Manejar excepciones
            return 'Error: ' . $e->getMessage();
        }
    }

    public function createUser()
    {
        // dd($this->perfil);
        $this->validate();
        try {
            $usuario = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'telefono' => $this->telefono,
                'perfil_id' => $this->perfil,
                'url' => $this->url_tienda,
                'password' => md5($this->password),
            ])->assignRole('Alumno');
            $combo = Name::find($this->perfil);
            $cartera = Cartera::create([
                'estado' => 'pendiente',
                'fecha' => Carbon::now()->toDateString(),
                'saldo' => $combo->precio,
                'alumno_id' => $usuario->id
            ]);
            // $this->comision($cartera->id);
            if ($this->perfil) {
                if ($this->suscripcion($this->perfil, $usuario->id)) {
                    $this->emit('alert', 'Registro creado con suscripciones exitosamente!');
                }
            }
            $this->emit('alert', 'Registro creado exitosamente!');
            $this->enviarDatosExternos($usuario);
            Mail::to($usuario->email)->send(new UserRegisteredMail($usuario));

            return redirect()->to('/admin/usuarios/' . $usuario->id);
        } catch (\Exception $th) {
            dd('alert', $th->getMessage());
        }
    }

    public function comision($cartera_id)
    {
        $user = Auth::user();
        if ($user->hasRole('Vendedor')) {
            Comision::create([
                'vendedor_id' => auth()->user()->id,
                'comision_id' => 1,
                'cartera_id' => $cartera_id
            ]);
            return true;
        }
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

    public function render()
    {
        $roles = Role::get();
        $perfiles = Name::all();
        return view('livewire.users.create-user', compact('roles', 'perfiles'))->extends('adminlte::page');
    }
}
