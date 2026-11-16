<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ApiConsumer;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\ClientRepository;
use Illuminate\View\View;
use Laravel\Passport\Passport;
use Illuminate\Support\Str;

class ApiConsumerController extends Controller
{
    

    public function index(): View
    {
        $consumers = ApiConsumer::with('passportClient')->latest()->paginate(10);
        return view('api-consumers.index', compact('consumers'));
    }

   public function store(Request $request)
    {
        $request->validate([
        'system_name' => 'required|string|max:255',
    ]);

    // 1. Utilizar el ClientRepository de Passport para crear el cliente de tipo "Client Credentials"
    $clientRepository = app(ClientRepository::class);

    $client = $clientRepository->create(
        userId: null, // null para máquinas (Machine-to-Machine)
        name: $request->system_name,
        redirectUris: '',
        personalAccess: false,
        password: false,
        confidential: true // Asegura que se genere un secreto cifrado
    );

    // 2. El repositorio genera automáticamente el secreto plano y te lo devuelve sin hashear
    // a través de la propiedad dinámica $client->secret (solo disponible en esta instancia).
    $plainSecret = $client->secret;

    // 3. Retornar los datos al usuario
    return response()->json([
        'client_id' => $client->getKey(),
        'client_secret' => $plainSecret,
        'message' => 'Client created successfully. Please store the secret securely, as it cannot be retrieved again.'
    ]);
    }
}
