@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<div class="container-fluid px-0">
    <!-- Encabezado de la página -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0 text-gray-800">Panel de Control</h2>
        <button class="btn btn-primary shadow-sm">
            <i class="bi bi-download me-1"></i> Generar Reporte
        </button>
    </div>

    <!-- Tarjetas de Resumen -->
    <div class="row g-4 mb-4">
        <!-- Tarjeta 1 -->
        <div class="col-12 col-md-6 col-xl-3">
            <a href="{{ route('authorizedsystem.create') }}" class="card border-0 shadow-sm h-100 py-2 text-decoration-none" style="border-left: 4px solid #0d6efd !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="font-size: 0.8rem;">
                                Sistemas Registrados</div>
                            <div class="h5 mb-0 fw-bold text-gray-800">4</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-pc-display-horizontal fs-2 text-muted opacity-50"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Tarjeta 2 -->
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100 py-2" style="border-left: 4px solid #198754 !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1" style="font-size: 0.8rem;">
                                Consultas realizadas</div>
                            <div class="h5 mb-0 fw-bold text-gray-800">18</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-clipboard2-check fs-2 text-muted opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tarjeta 2 -->
        <div class="col-12 col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100 py-2" style="border-left: 4px solid #194587 !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col me-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1" style="font-size: 0.8rem;">
                                APIs consumidas</div>
                            <div class="h5 mb-0 fw-bold text-gray-800">18</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-clipboard2-check fs-2 text-muted opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Área de contenido amplio -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 border-bottom-0">
                    <h6 class="m-0 fw-bold text-primary">Actividad Reciente</h6>
                </div>
                <div class="card-body">
                    <p class="text-muted">Como los usuarios ingresan a través de su cuenta de Google, puedes usar el middleware de Laravel (junto con Laravel Socialite) para proteger esta ruta y asegurar que siempre exista una sesión activa.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection