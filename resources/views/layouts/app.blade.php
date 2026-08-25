<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Mi Aplicación</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        /* Variables y ajustes generales */
        :root {
            --sidebar-width: 260px;
            --topbar-height: 65px;
        }
        body {
            background-color: #f4f6f9;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }

        /* Sidebar (Menú Lateral Estático) - Ahora ocupa toda la altura */
        .sidebar {
            width: var(--sidebar-width);
            position: fixed;
            top: 0; /* Comienza desde el borde superior absoluto */
            bottom: 0;
            left: 0;
            z-index: 1040; /* Por encima del topbar para efecto móvil */
            background-color: #212529; /* Dark theme */
            color: #fff;
            overflow-y: auto;
            transition: transform 0.3s ease-in-out;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        
        /* Área del Logo haciendo juego con el Sidebar */
        .sidebar-brand {
            height: var(--topbar-height);
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            font-size: 1.25rem;
            background-color: #1a1d20; /* Un tono ligeramente más oscuro para enmarcar el logo */
            border-bottom: 1px solid rgba(255,255,255,0.05);
            text-decoration: none;
            color: #fff;
        }

        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 0.8rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.2s;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: #fff;
            background-color: rgba(255,255,255,0.05);
            border-left: 4px solid #0d6efd; /* Indicador visual sutil */
        }
        
        /* Submenús desplegables */
        .sidebar-submenu {
            background-color: #1a1d20;
        }
        .sidebar-submenu .nav-link {
            padding-left: 3rem;
            font-size: 0.9em;
            border-left: none !important; /* Quitamos el borde en submenús */
        }

        /* Topbar (Barra Superior Estática) - Ahora inicia después del Sidebar */
        .topbar {
            height: var(--topbar-height);
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            z-index: 1030;
            position: fixed;
            top: 0;
            right: 0;
            left: var(--sidebar-width); /* Respeta el ancho del menú lateral */
            transition: left 0.3s ease-in-out;
        }

        /* Contenido Principal */
        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--topbar-height);
            padding: 2rem;
            min-height: calc(100vh - var(--topbar-height));
            transition: margin-left 0.3s ease-in-out;
        }

        /* Íconos de acción (Topbar) */
        .action-icon {
            font-size: 1.25rem;
            color: #495057;
            position: relative;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 50%;
            transition: background-color 0.2s;
        }
        .action-icon:hover {
            background-color: #e9ecef;
        }
        .badge-notification {
            position: absolute;
            top: 2px;
            right: 2px;
            font-size: 0.65rem;
        }
        /* Estilos para los paneles de Notificaciones y Mensajes */
        .dropdown-panel {
            width: 320px;
            padding: 0;
            border: 0;
            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
        }
        .dropdown-panel-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
            padding: 0.75rem 1rem;
            border-radius: 0.375rem 0.375rem 0 0;
        }
        .dropdown-panel-body {
            max-height: 300px;
            overflow-y: auto;
        }
        /* Personalizar la barra de scroll del panel */
        .dropdown-panel-body::-webkit-scrollbar {
            width: 6px;
        }
        .dropdown-panel-body::-webkit-scrollbar-thumb {
            background-color: #ced4da;
            border-radius: 10px;
        }
        .dropdown-panel .dropdown-item {
            padding: 0.75rem 1rem;
            white-space: normal; /* Permite que el texto se adapte al ancho */
            transition: background-color 0.2s;
        }
        .dropdown-panel .dropdown-item:active {
            background-color: #e9ecef;
            color: inherit;
        }
        .icon-circle {
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        /* Responsive Design */
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .topbar {
                left: 0; /* En móvil, el topbar ocupa todo el ancho */
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar Estático con Logo Integrado -->
    <aside class="sidebar" id="sidebar">
        <!-- Logo / Marca -->
        <a href="#" class="sidebar-brand fw-bold text-center">
            <!-- Icono opcional para el logo -->
            {{-- <i class="bi bi-hexagon-fill text-primary me-2 fs-4"></i> --}}
            <img style="width:30px" src="/img/undc-ico(600).png" />
            <span class="ml-4">CONADIS</span>
        </a>

        <!-- Menú de Navegación -->
        <ul class="nav flex-column mb-auto py-3">
            <li class="nav-item">
                <a href="#" class="nav-link active">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-bar-chart"></i> Estadísticas
                </a>
            </li>

            <li class="nav-item">
                <a href="#submenuProyectos" data-bs-toggle="collapse" class="nav-link d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-folder2-open"></i> Proyectos</span>
                    <i class="bi bi-chevron-down fs-6"></i>
                </a>
                <div class="collapse sidebar-submenu" id="submenuProyectos">
                    <ul class="nav flex-column">
                        <li><a href="#" class="nav-link">Ver todos</a></li>
                        <li><a href="#" class="nav-link">Crear nuevo</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </aside>

    <!-- Topbar de Acciones -->
    <!-- Topbar de Acciones -->
    <header class="topbar d-flex align-items-center justify-content-between px-3 px-md-4">
        <div class="d-flex align-items-center">
            <!-- Botón toggle para móviles -->
            <button class="btn btn-light d-lg-none me-3" type="button" id="sidebarToggle">
                <i class="bi bi-list fs-4"></i>
            </button>
            <h5 class="mb-0 text-muted d-none d-md-block fw-normal">@yield('title', 'Panel General')</h5>
        </div>

        <div class="d-flex align-items-center gap-3">
            
            <!-- DROPDOWN DE MENSAJES -->
            <div class="dropdown">
                <div class="action-icon" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Mensajes">
                    <i class="bi bi-envelope"></i>
                    <span class="position-absolute translate-middle badge rounded-pill bg-danger badge-notification">2</span>
                </div>
                
                <div class="dropdown-menu dropdown-menu-end dropdown-panel">
                    <div class="dropdown-panel-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 fw-bold">Mensajes</h6>
                        <a href="#" class="text-muted small text-decoration-none">Marcar leídos</a>
                    </div>
                    
                    <div class="dropdown-panel-body">
                        <!-- Mensaje 1 -->
                        <a href="#" class="dropdown-item d-flex align-items-center border-bottom">
                            <img src="https://ui-avatars.com/api/?name=Maria+Gomez&background=random" class="rounded-circle me-3" width="40" height="40" alt="Avatar">
                            <div class="overflow-hidden">
                                <div class="fw-bold fs-6">María Gómez</div>
                                <!-- text-truncate corta el texto con "..." si es muy largo -->
                                <div class="small text-muted text-truncate">Hola, te envío los archivos para la revisión del proyecto.</div>
                                <div class="small text-primary mt-1"><i class="bi bi-clock me-1"></i>Hace 15 min</div>
                            </div>
                        </a>
                        
                        <!-- Mensaje 2 -->
                        <a href="#" class="dropdown-item d-flex align-items-center border-bottom bg-light">
                            <img src="https://ui-avatars.com/api/?name=Carlos+Ruiz&background=random" class="rounded-circle me-3" width="40" height="40" alt="Avatar">
                            <div class="overflow-hidden">
                                <div class="fw-bold fs-6">Carlos Ruiz</div>
                                <div class="small text-muted text-truncate">¿Podemos tener una reunión mañana?</div>
                                <div class="small text-muted mt-1"><i class="bi bi-clock me-1"></i>Hace 2 horas</div>
                            </div>
                        </a>
                    </div>
                    
                    <div class="p-2 text-center border-top">
                        <a href="#" class="small text-decoration-none fw-bold">Ver todos los mensajes</a>
                    </div>
                </div>
            </div>
            
            <!-- DROPDOWN DE NOTIFICACIONES -->
            <div class="dropdown">
                <div class="action-icon" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Notificaciones">
                    <i class="bi bi-bell"></i>
                    <span class="position-absolute translate-middle badge rounded-pill bg-warning text-dark badge-notification">3</span>
                </div>
                
                <div class="dropdown-menu dropdown-menu-end dropdown-panel">
                    <div class="dropdown-panel-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 fw-bold">Notificaciones</h6>
                        <a href="#" class="text-muted small text-decoration-none">Limpiar</a>
                    </div>
                    
                    <div class="dropdown-panel-body">
                        <!-- Notificación de Éxito -->
                        <a href="#" class="dropdown-item d-flex align-items-center border-bottom">
                            <div class="icon-circle bg-success bg-opacity-10 text-success me-3 flex-shrink-0">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <div>
                                <div class="small fw-bold">Reporte generado</div>
                                <div class="small text-muted">El reporte de ventas de enero está listo.</div>
                                <div class="small text-muted mt-1" style="font-size: 0.75rem;">Hace 10 min</div>
                            </div>
                        </a>
                        
                        <!-- Notificación de Alerta -->
                        <a href="#" class="dropdown-item d-flex align-items-center border-bottom bg-light">
                            <div class="icon-circle bg-warning bg-opacity-10 text-warning me-3 flex-shrink-0">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                            </div>
                            <div>
                                <div class="small fw-bold">Espacio de disco</div>
                                <div class="small text-muted">Has alcanzado el 80% de tu capacidad de almacenamiento.</div>
                                <div class="small text-muted mt-1" style="font-size: 0.75rem;">Hace 1 hora</div>
                            </div>
                        </a>

                        <!-- Notificación de Sistema -->
                        <a href="#" class="dropdown-item d-flex align-items-center border-bottom">
                            <div class="icon-circle bg-primary bg-opacity-10 text-primary me-3 flex-shrink-0">
                                <i class="bi bi-shield-lock-fill"></i>
                            </div>
                            <div>
                                <div class="small fw-bold">Nuevo inicio de sesión</div>
                                <div class="small text-muted">Se detectó un acceso desde Chrome en Windows.</div>
                                <div class="small text-muted mt-1" style="font-size: 0.75rem;">Ayer</div>
                            </div>
                        </a>
                    </div>
                    
                    <div class="p-2 text-center border-top">
                        <a href="#" class="small text-decoration-none fw-bold">Ver historial completo</a>
                    </div>
                </div>
            </div>

            <!-- Perfil de Usuario (Se mantiene igual) -->
            <div class="dropdown ms-2">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://ui-avatars.com/api/?name=User+Google&background=0D8ABC&color=fff" alt="Perfil" width="40" height="40" class="rounded-circle shadow-sm">
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="dropdownUser">
                    <li><h6 class="dropdown-header">Hola, Usuario</h6></li>
                    <li><a class="dropdown-item py-2" href="#"><i class="bi bi-person me-2"></i> Mi Perfil</a></li>
                    <li><a class="dropdown-item py-2" href="#"><i class="bi bi-gear me-2"></i> Configuración</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item py-2 text-danger" href="#"><i class="bi bi-box-arrow-right me-2"></i> Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
    </header>

    <!-- Área de Contenido Principal -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Lógica del Sidebar en Móviles -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');

            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('show');
            });

            // Cierra el menú al hacer clic fuera de él en dispositivos móviles
            document.addEventListener('click', function(event) {
                if (window.innerWidth < 992) {
                    if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
                        sidebar.classList.remove('show');
                    }
                }
            });
        });
    </script>
</body>
</html>