<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de API Consumers</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4">Sistemas Autorizados (OAuth 2.0)</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('client_secret'))
        <div class="alert alert-warning shadow-sm">
            <h5 class="alert-heading"><i class="bi bi-exclamation-triangle"></i> ¡Guarde estas credenciales!</h5>
            <p class="mb-1">Este es el <strong>Client Secret</strong>. Solo se mostrará una vez. Si lo pierde, deberá regenerar el cliente.</p>
            <hr>
            <p class="mb-0 font-monospace fs-5 user-select-all">{{ session('client_secret') }}</p>
        </div>
    @endif

    <div class="row">
        <!-- Formulario -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">Registrar Nuevo Sistema</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('api-consumers.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nombre del Sistema</label>
                            <input type="text" name="system_name" class="form-control @error('system_name') is-invalid @enderror" value="{{ old('system_name') }}" >
                            @error('system_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Dirección IP (Opcional)</label>
                            <input type="text" name="ip_address" class="form-control @error('ip_address') is-invalid @enderror" value="{{ old('ip_address') }}" placeholder="Ej: 192.168.1.10">
                            <div class="form-text">Dejar en blanco para permitir cualquier IP.</div>
                            @error('ip_address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Rate Limit (Consultas/minuto)</label>
                            <input type="number" name="rate_limit" class="form-control @error('rate_limit') is-invalid @enderror" value="{{ old('rate_limit', 60) }}" required>
                            @error('rate_limit') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Generar Credenciales</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tabla -->
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Sistema</th>
                                    <th>Client ID</th>
                                    <th>IP Autorizada</th>
                                    <th>Rate Limit</th>
                                    <th>Fecha Creación</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($consumers as $consumer)
                                    <tr>
                                        <td class="fw-bold">{{ $consumer->system_name }}</td>
                                        <td class="font-monospace text-muted">{{ $consumer->client_id }}</td>
                                        <td>
                                            @if($consumer->ip_address)
                                                <span class="badge bg-info text-dark">{{ $consumer->ip_address }}</span>
                                            @else
                                                <span class="badge bg-secondary">Cualquiera</span>
                                            @endif
                                        </td>
                                        <td>{{ $consumer->rate_limit }} req/min</td>
                                        <td>{{ $consumer->created_at->format('d M Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-3 text-muted">No hay sistemas registrados aún.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $consumers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>