<?php

namespace App\Http\Controllers;

use App\Models\AuthorizedSystem;
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

        return redirect()->route('authorizedsystem.index')
                         ->with('success', 'Sistema registrado exitosamente.');
    }
    public function index(){
        $systems = AuthorizedSystem::latest()->paginate(10);

        return view('authorizedsystems.index', compact('systems'));
    }
}