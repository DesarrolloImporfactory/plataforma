<?php

namespace App\Http\Livewire\Users;

use App\Models\Cartera;
use App\Models\Comision;
use App\Models\Course;
use App\Models\Name;
use App\Models\Perfil;
use App\Models\Suscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Livewire\Component;

class UpdateUser extends Component
{
    public $user, $cartera = 'false', $editar = 'false';
    public $email, $telefono, $name, $password, $enlace, $perfil, $rol = 'Alumno';

    public function mount($user)
    {
        $this->user = User::find($user);
        $this->email = $this->user->email;
        $this->telefono = $this->user->telefono;
        $this->enlace = $this->user->url;
        $this->password = $this->user->password;
        $this->name = $this->user->name;
        if ($this->user->carteras->count() > 0) {
            $this->cartera = 'true';
        }
    }
    public function render()
    {
        $roles = Role::get();
        $perfiles = Name::all();
        return view('livewire.users.update-user', compact('roles', 'perfiles'));
    }

    protected $rules = [
        'email' => 'required|string|email|max:255',
        'name' => 'required|string|max:255',
        'password' => 'required|string|min:8',
        'telefono' => 'required',
        'enlace' => 'nullable'
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function updateUser()
    {
        $this->validate();
        $data = User::findOrFail($this->user->id);
        if ($this->password == $data->password) {
            $password = $data->password;
        } else {
            $password = md5($this->password);
        }
        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
            'telefono' => $this->telefono,
            'password' => $password,
            'url' => $this->url
        ]);
        $this->emit('alert', 'Registro actualizado exitosamente!');
    }

    public function createCartera()
    {
        if ($this->user->perfil_id) {
            $combo = Name::find($this->user->perfil_id);
            $cartera = Cartera::create([
                'estado' => $combo->precio == 0 ? 'pagado' : 'pendiente',
                'fecha' => Carbon::now()->toDateString(),
                'saldo' => $combo->precio,
                'alumno_id' => $this->user->id
            ]);
            $this->comision($cartera->id);
            return redirect()->to('/admin/usuarios/' . $this->user->id);
        } else {
            $this->emit('alert', 'Este alumno no tiene asignado un perfil!');
        }
    }

    public function comision($cartera_id)
    {
        $user = Auth::user();
        if ($user->hasRole('Vendedor')) {
            Comision::create([
                'vendedor_id' => auth()->user()->id,
                'tipo_id' => 1,
                'cartera_id' => $cartera_id
            ]);
            return true;
        }
    }

   
}
