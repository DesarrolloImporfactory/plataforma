<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cartera;
use App\Models\Comision;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $vendedores = User::whereHas("roles", function ($q) {
            $q->where("name", "Vendedor");
        })->count();
        $alumnos = User::whereHas("roles", function ($q) {
            $q->where("name", "Alumno");
        })->count();
        $pagado = Cartera::where('estado', 'pagado')->sum('saldo');
        $deuda = Cartera::where('estado', '!=', 'pagado')->sum('saldo');

        $usuariosConMasInsumos = Comision::select('users.name', DB::raw('SUM(valor) as total'))
            ->join('users', 'comisions.vendedor_id', '=', 'users.id')
            ->whereNotNull('comisions.vendedor_id')
            ->groupBy('users.name')
            ->orderByDesc('total')
            ->limit(5)
            ->get();
        $data = [];
        foreach ($usuariosConMasInsumos as $consulta2) {
            $data[] = [
                'name' => $consulta2->name,
                'y' => $consulta2->total
            ];
        }

        $cantidadCarterasPorEstado = Cartera::select('estado', DB::raw('count(*) as total'))
            ->groupBy('estado')
            ->get();
        $data2 = [];
        foreach ($cantidadCarterasPorEstado as $consulta2) {
            $data2[] = [
                'name' => $consulta2->estado,
                'y' => $consulta2->total
            ];
        }
        $datos = [
            'vendedores' => $vendedores,
            'alumnos' => $alumnos,
            'pagado' => $pagado,
            'deuda' => $deuda,
            'data' => $data = json_encode($data),
            'data2' => $data2 = json_encode($data2),
        ];

        return view('admin.index', $datos);
    }

    public function setings()
    {
        return view('admin.setings.index');
    }
}
