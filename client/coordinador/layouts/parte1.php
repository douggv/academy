<?php
    //incluimos la configuración
    require_once __DIR__ . '/../../../app/config.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Coach - Basketball Academy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    :root {
        /* Paleta Profesional/Administrativa */
        --admin-dark: #1e293b;       /* Azul pizarra oscuro */
        --admin-sidebar: #0f172a;    /* Fondo lateral profundo */
        --admin-accent: #f97316;     /* Naranja básquet (solo acentos) */
        --admin-bg: #f8fafc;         /* Gris casi blanco para el fondo */
        --text-muted: #94a3b8;
        --border-color: #e2e8f0;
    }

    body { 
        font-family: 'Inter', 'Poppins', sans-serif; 
        background-color: var(--admin-bg); 
        color: #334155;
    }

    .bebas { 
        font-family: 'Bebas Neue', cursive; 
        letter-spacing: 1px;
    }

    /* Sidebar Wrapper */
    .wrapper { display: flex; width: 100%; align-items: stretch; }

    #sidebar {
        min-width: 260px;
        max-width: 260px;
        background: var(--admin-sidebar);
        color: #fff;
        transition: all 0.3s;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        box-shadow: 4px 0 10px rgba(0,0,0,0.1);
    }

    #sidebar .sidebar-header { 
        padding: 25px 20px; 
        background: var(--admin-sidebar);
        border-bottom: 1px solid rgba(255,255,255,0.05);
    }

    #sidebar .sidebar-header h3 {
        font-size: 1.4rem;
        color: var(--admin-accent);
    }

    #sidebar ul.components { 
        padding: 15px 0; 
    }
    
    #sidebar ul li a {
        padding: 12px 25px;
        display: block;
        color: #cbd5e1;
        text-decoration: none;
        transition: all 0.2s;
        font-weight: 400;
        font-size: 0.95rem;
    }

    #sidebar ul li a:hover {
        background: rgba(255,255,255,0.05);
        color: #fff;
        padding-left: 30px;
    }

    #sidebar ul li.active > a {
        background: var(--admin-accent);
        color: white;
    }

    #sidebar ul li a i { 
        margin-right: 12px; 
        width: 20px; 
        text-align: center;
        opacity: 0.8;
    }

    /* Contenido Principal */
    #content { 
        width: 100%; 
        padding: 25px 35px; 
    }

    .navbar-admin {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 8px !important;
        margin-bottom: 30px;
    }

    .navbar-admin .fw-bold {
        color: var(--admin-dark);
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        #sidebar { margin-left: -260px; position: fixed; z-index: 1000; }
        #sidebar.active { margin-left: 0; }
    }

    /* Estilo Botón Salir */
    .logout-section { 
        margin-top: auto; 
        background: rgba(0,0,0,0.2);
    }

    .logout-link {
        color: #f87171 !important; /* Rojo suave */
    }

    .logout-link:hover { 
        background-color: #ef4444 !important; 
        color: white !important;
    }

    .badge-season {
        background-color: var(--admin-dark);
        padding: 6px 12px;
        font-weight: 500;
    }
</style>
</head>
<body>

<div class="wrapper">
    <nav id="sidebar">
        <div class="sidebar-header text-center">
            <h3 class="bebas mb-0">Gestión Pro</h3>
            <small style="color: var(--text-muted); text-transform: uppercase; font-size: 0.7rem;">Panel Administrativo</small>
        </div>

        <ul class="list-unstyled components">
            <li class="active">
                <a href="#"><i class="fas fa-chart-line"></i> Dashboard</a>
            </li>
            <li>
                <a href="<?php echo $URL . '/client/coordinador/views/universidades/index.php'; ?>"><i class="fas fa-university"></i>Universidades</a>
            </li>
            <li>
                <a href="<?php echo $URL . '/client/coordinador/views/universidades/create.php'; ?>"><i class="fas fa-plus-circle"></i> Registrar Universidad</a>
            </li>    
            <li>
                <a href="<?php echo $URL . '/client/coordinador/views/jugadores/index.php'; ?>"><i class="fas fa-id-card"></i> Ver Jugadores</a>
            </li>
                <li>
                    <a href="<?php echo $URL . '/client/coordinador/views/entrenadores/index.php'; ?>"><i class="fas fa-user-tie"></i> Ver Entrenadores</a>
            </li>
            <li>
                <a href="<?php echo $URL . '/client/coordinador/views/entrenadores/create.php'; ?>"><i class="fas fa-user-tie"></i> Registrar Entrenadores</a>
            </li>
            <li>
                <a href="<?php echo $URL . '/client/coordinador/views/torneos/index.php'; ?>"><i class="fas fa-trophy"></i> Registrar Torneo</a>
            </li>
        </ul>

        <div class="logout-section">
            <ul class="list-unstyled mb-0">
                <li>
                    <a href="<?php echo $URL; ?>/app/controllers/controllers_entrenador/logout.php" class="logout-link">
                        <i class="fas fa-power-off"></i> Finalizar Sesión
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-admin px-3 py-2 shadow-sm">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn btn-outline-secondary d-md-none">
                    <i class="fas fa-align-left"></i>
                </button>
                <span class="ms-2 fw-bold text-uppercase">
                   <i class="fas fa-user-circle me-1"></i> COORDINADOR: <?php echo $usuarioLogueado['nombre_usuario']; ?>
                </span>
                
                <div class="ms-auto">
                    <span class="badge badge-season rounded-pill">Temporada 2026</span>
                </div>
            </div>
        </nav>

