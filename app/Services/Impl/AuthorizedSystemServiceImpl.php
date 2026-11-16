<?php
namespace App\Services\Impl;

use App\Jobs\NotificarCorreoBienvenida;
use App\Models\AuthorizedSystem;
use App\Services\AuthorizedSystemService;
class AuthorizedSystemServiceImpl implements AuthorizedSystemService{
    public function createSystem(array $data): AuthorizedSystem
    {
        // Convertimos la cadena de IPs separadas por coma en un array JSON válido
        if (!empty($data['allowed_ips'])) {
            $ipsArray = array_map('trim', explode(',', $data['allowed_ips']));
            // Filtramos elementos vacíos en caso de que escriban ",,"
            $data['allowed_ips'] = json_encode(array_filter($ipsArray)); 
        } else {
            $data['allowed_ips'] = null;
        }
        $authorizeSystem = new AuthorizedSystem();
        $authorizeSystem->name = $data["name"];
        $authorizeSystem->is_active = $data["is_active"];
        $authorizeSystem->rate_limit = $data["rate_limit"];
        $authorizeSystem->allowed_ips = $data["allowed_ips"];
        $authorizeSystem->save();
        \Illuminate\Support\Facades\Log::info("Llegó al servicio, intentando despachar el job para el ID: " . $authorizeSystem->id);
        NotificarCorreoBienvenida::dispatch($authorizeSystem)->onConnection('database')->onQueue('emails');
        return $authorizeSystem;
    }
}