<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;

class AuthenticateJWT
{
    public function handle($request, Closure $next)
    {
        dd($request);
        try {
            // Verificar si el token está en la cookie o en los headers
            $token = $request->cookie('token') ?? $request->header('Authorization');
            $token = str_replace('Bearer ', '', $token); // Eliminar el prefijo Bearer


            // Decodificar el token para obtener los datos del usuario
            $payload = JWTAuth::setToken($token)->getPayload();

            // Obtener el correo electrónico del payload del token
            $email = $payload->get('correo');

            // Buscar al usuario en la base de datos basado en el email
            $user = User::where('email', $email)->first();

            if (!$user) {
                return response()->json(['error' => 'Usuario no encontrado'], 404);
            }

            // Iniciar sesión automáticamente en Laravel (usando Auth)
            auth()->login($user);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token inválido o expirado'], 401);
        }

        // Continuar con la solicitud si el token es válido
        return $next($request);
    }
}
