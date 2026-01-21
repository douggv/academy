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
            --naranja-basket: #ff6600;
            --negro-pro: #1a1a1a;
            --gris-suave: #2c2c2c;
        }

        body { font-family: 'Poppins', sans-serif; background-color: #f4f4f4; }
        .bebas { font-family: 'Bebas Neue', cursive; }

        /* Sidebar Wrapper */
        .wrapper { display: flex; width: 100%; align-items: stretch; }

        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background: var(--negro-pro);
            color: #fff;
            transition: all 0.3s;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        #sidebar .sidebar-header { padding: 20px; background: var(--naranja-basket); }
        #sidebar ul.components { padding: 20px 0; }
        
        #sidebar ul li a {
            padding: 15px 20px;
            display: block;
            color: white;
            text-decoration: none;
            transition: 0.3s;
            font-weight: 500;
        }

        #sidebar ul li a:hover {
            background: var(--naranja-basket);
            padding-left: 30px;
        }

        #sidebar ul li a i { margin-right: 10px; width: 20px; text-align: center; }

        /* Contenido Principal */
        #content { width: 100%; padding: 20px; }

        .navbar-admin {
            background: white;
            border-bottom: 2px solid var(--naranja-basket);
            margin-bottom: 30px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            #sidebar { margin-left: -250px; position: fixed; z-index: 1000; }
            #sidebar.active { margin-left: 0; }
        }

        /* Estilo Botón Salir */
        .logout-section { margin-top: auto; border-top: 1px solid var(--gris-suave); }
        .logout-link:hover { background-color: #dc3545 !important; }
    </style>
</head>
<body>

<div class="wrapper">
    <nav id="sidebar">
        <div class="sidebar-header text-center">
            <h3 class="bebas mb-0">Coach Panel</h3>
        </div>

        <ul class="list-unstyled components">
            <li class="active">
                <a href="#"><i class="fas fa-home"></i> Inicio</a>
            </li>
            <li>
                <a href="#"><i class="fas fa-user-plus"></i> Agregar Jugadores</a>
            </li>
            <li>
                <a href="#"><i class="fas fa-users"></i> Ver Jugadores</a>
            </li>
            <li>
                <a href="#"><i class="fas fa-calendar-check"></i> Registrar Asistencia</a>
            </li>
            <li>
                <a href="#"><i class="fas fa-trophy"></i> Agregar a Torneos</a>
            </li>
        </ul>

        <div class="logout-section">
            <ul class="list-unstyled">
                <li>
                    <a href="logout.php" class="logout-link text-white">
                        <i class="fas fa-sign-out-alt"></i> Salir del Sistema
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-admin px-3 py-2 shadow-sm rounded">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn btn-dark d-md-none">
                    <i class="fas fa-align-left"></i>
                </button>
                <span class="ms-2 fw-bold text-uppercase">Bienvenido, Coach <?php echo "Pérez"; ?></span>
                
                <div class="ms-auto">
                    <span class="badge bg-dark">Temporada 2026</span>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="bebas text-dark border-bottom pb-2">Resumen de Entrenamiento</h2>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card bg-dark text-white shadow">
                        <div class="card-body">
                            <h5>Total Jugadores</h5>
                            <h2 class="text-warning">24</h2>
                        </div>
                    </div>
                </div>
                </div>
        </div>
    </div>
</div>