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

        try {
            // Obtener el token JWT del enlace 
            $token = $_GET['token'];

            // Verificar si el token es válido
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
