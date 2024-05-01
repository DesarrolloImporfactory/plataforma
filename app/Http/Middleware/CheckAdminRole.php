<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdminRole
{

    public function handle(Request $request, Closure $next)
    {
        if (!$request->user()->can('Admin roles')) {
            return redirect()->route('admin.alumnos.all');
        }

        return $next($request);
    }
}
