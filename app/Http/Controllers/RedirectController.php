<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RedirectController extends Controller
{
    public function redirectUser(string $id)
    {
        $sessionData = DB::table('sessions')->where('id', $id)->first();
        Auth::loginUsingId($sessionData->user_id);
        return redirect('/cursos/index')->with('mensaje','Bien venido al sistema educativo');
    }
}
