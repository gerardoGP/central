@extends('layouts.app')

@section('title', 'Nuevo Sistema Autorizado')

@section('content')
<div class="container-fluid px-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0 text-gray-800">Registrar Sistema</h2>
        <a href="#" class="btn btn-outline-secondary shadow-sm">
            <i class="bi bi-arrow-left me-1"></i> Volver
        </a>
    </div>

    <div class="row">
        <div class="col-12 col-lg-8 col-xl-6 mx-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    
                    <!-- Mostrar errores generales de validación -->
                    @if ($errors->any())
                        <div class="alert alert-danger mb-4 rounded-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('authorizedsystem.store') }}" method="POST">
                        @csrf

                        <!-- Nombre e Identificador -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-12">
                                <label for="name" class="form-label fw-semibold">Nombre del Sistema <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Ej. CRM Ventas" required>
                                <div class="form-text text-muted" style="font-size: 0.75rem;">
                                <i class="bi bi-info-circle me-1"></i> Nombre del sistema.
                            </div>
                            </div>
                            <div class="col-md-12">
                                <label for="identifier" class="form-label fw-semibold">Identificador Único <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('identifier') is-invalid @enderror" id="identifier" name="identifier" value="{{ old('identifier') }}" placeholder="ej. crm_ventas_prod" required>
                                <div class="form-text text-muted" style="font-size: 0.75rem;">Usado para autenticación de API.</div>
                            </div>
                        </div>

                        <!-- Límite de Peticiones y Estado -->
                        <div class="row g-3 mb-4 align-items-center">
                            <div class="col-md-12">
                                <label for="rate_limit" class="form-label fw-semibold">Límite de Peticiones (Rate Limit)</label>
                                <div class="input-group">
                                    <input type="number" class="form-control @error('rate_limit') is-invalid @enderror" id="rate_limit" name="rate_limit" value="{{ old('rate_limit', 60) }}" min="1">
                                    <span class="input-group-text bg-light">req / min</span>
                                </div>
                            </div>
                            <div class="col-md-12 mt-md-5">
                                <div class="form-check form-switch fs-5">
                                    <input class="form-check-input cursor-pointer" type="checkbox" role="switch" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                    <label class="form-check-label fs-6 mt-1 ms-2" for="is_active">Sistema Activo</label>
                                </div>
                            </div>
                        </div>

                        <!-- IPs Permitidas -->
                        <div class="mb-4">
                            <label for="allowed_ips" class="form-label fw-semibold">IP Permitida <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('allowed_ips') is-invalid @enderror" id="allowed_ips" name="allowed_ips" rows="3" placeholder="192.168.1.1">{{ old('allowed_ips') }}</textarea>
                            <div class="form-text text-muted" style="font-size: 0.75rem;">
                                <i class="bi bi-info-circle me-1"></i> Separa múltiples direcciones IP con comas. Déjalo en blanco para permitir cualquier IP.
                            </div>
                        </div>

                        <hr class="my-4 text-muted">

                        <!-- Botón de Envío -->
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm">
                                <i class="bi bi-save me-2"></i> Guardar Sistema
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection