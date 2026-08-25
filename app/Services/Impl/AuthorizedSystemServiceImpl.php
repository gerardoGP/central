<?php
namespace App\Services\Impl;

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

        return AuthorizedSystem::create($data);
    }
}