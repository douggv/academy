<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php"><i class="bi bi-basketball me-2"></i><?php echo APP_NAME; ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $URL; ?>/client/ojeador/views/universidades.php">Jugadores</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $URL; ?>/client/ojeador/views/universidades.php">Universidades</a></li>
                    <li class="nav-item ms-lg-4"><a class="nav-link" href="#servicios"><?php echo $usuario_sesion; ?></a> </li>
                    <li class="nav-item ms-lg-2"><a class="nav-link" href="#servicios"><?php echo $rol_sesion; ?></a></li>
                    <li class="nav-item ms-lg-2"><a class="btn btn-warning" href="<?php echo $URL; ?>/app/controllers/logout.php">Salir</a></li>
                </ul>
            </div>
        </div>
</nav>