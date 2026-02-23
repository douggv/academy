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
    <link rel="icon" href="../../../public/assets/img/logoBasquet2.png" type="image/png">
    
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
            <h3 class="bebas mb-0"></h3>
        </div>

        <ul class="list-unstyled components">
            <li class="active">
                <a href="#"><i class="fas fa-home"></i> Inicio</a>
            </li>
            <li>
                <a href="<?php echo $URL . '/client/entrenador/views/jugadores/create.php'; ?>"><i class="fas fa-user-plus"></i> Agregar Jugadores</a>
            </li>
            <li>
                <a href="<?php echo $URL . '/client/entrenador/views/jugadores/index.php'; ?>"><i class="fas fa-users"></i> Ver Jugadores</a>
            </li>
            <li>
                <a href="<?php echo $URL . '/client/entrenador/views/jugadores/reporte.php'; ?>"><i class="fas fa-calendar-check"></i> Reporte de Jugadores</a>
            </li>
            <li>
                <a href="<?php echo $URL . '/client/entrenador/views/torneos/index.php'; ?>"><i class="fas fa-trophy"></i> Ver Torneos</a>
            </li>
        </ul>

        <div class="logout-section">
            <ul class="list-unstyled">
                <li>
                    <a href="<?php echo $URL; ?>/app/controllers/controllers_entrenador/logout.php" class="logout-link text-white">
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
                <span class="ms-2 fw-bold text-uppercase">Bienvenido, Coach <?php echo $usuarioLogueado['nombre_usuario']; ?></span>
                
                <div class="ms-auto">
                    <span class="badge bg-dark">Temporada 2026</span>
                </div>
            </div>
        </nav>

