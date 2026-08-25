<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreAuthorizedSystemRequest;
use App\Services\AuthorizedSystemService;
class AuthorizedSystemController extends Controller
{
    private AuthorizedSystemService $service;
    public function __construct(AuthorizedSystemService $service) {
        $this->service = $service;
    }
    public function create(){
        return view('authorizedsystems.create');
    }
    public function store(StoreAuthorizedSystemRequest $request){
        // Pasamos los datos validados al servicio
        $this->service->createSystem($request->validated());

        return redirect()->route('authorized_systems.index')
                         ->with('success', 'Sistema registrado exitosamente.');
    }
}