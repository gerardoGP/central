<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyApiConsumerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $passportClient = Auth::guard('client')->user();

        if (!$passportClient) {
            return response()->json(['message' => 'No autorizado. Token inválido o ausente.'], 401);
        }

        $apiConsumer = ApiConsumer::where('client_id', $passportClient->id)->first();

        if (!$apiConsumer) {
            return response()->json(['message' => 'Configuración de cliente no encontrada.'], 403);
        }

        // Validación de IP (Lista Blanca)
        if (!empty($apiConsumer->ip_address) && $request->ip() !== $apiConsumer->ip_address) {
            return response()->json(['message' => 'Acceso denegado. IP no autorizada: ' . $request->ip()], 403);
        }

        // Adjuntamos la configuración al request para que el Rate Limiter la pueda leer
        $request->attributes->set('api_consumer_rate_limit', $apiConsumer->rate_limit);
        $request->attributes->set('api_consumer_id', $apiConsumer->id);

        return $next($request);
    }
}
