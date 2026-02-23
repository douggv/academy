<?php
    include 'app/config.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME; ?> | La Cancha de los Sueños</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="icon" href="public/assets/img/logoBasquet2.png" type="image/png">
    <style>
        :root {
            --naranja-basket: #ff6600;
            --negro-pro: #1a1a1a;
        }

        body { font-family: 'Poppins', sans-serif; }
        .bebas { font-family: 'Bebas Neue', cursive; }

        /* Navbar personalizada */
        .navbar {
            background-color: var(--negro-pro);
            border-bottom: 3px solid var(--naranja-basket);
        }
        .navbar-brand { font-family: 'Bebas Neue'; font-size: 2rem; color: var(--naranja-basket) !important; }
        .nav-link { color: white !important; font-weight: 500; text-transform: uppercase; }
        .nav-link:hover { color: var(--naranja-basket) !important; }

        /* Carrusel */
        .carousel-item {
            height: 80vh;
            min-height: 400px;
            background: no-repeat center center scroll;
            background-size: cover;
        }
        .carousel-caption {
            background: rgba(0, 0, 0, 0.6);
            padding: 20px;
            border-radius: 10px;
            bottom: 20%;
        }
        .carousel-caption h2 { font-family: 'Bebas Neue'; font-size: 4rem; color: var(--naranja-basket); }

        /* Secciones */
        .section-padding { padding: 80px 0; }
        .title-section { font-family: 'Bebas Neue'; font-size: 3rem; margin-bottom: 30px; }
        .icon-box { color: var(--naranja-basket); font-size: 3rem; }

        .footer {
            background-color: var(--negro-pro);
            color: white;
            padding: 40px 0;
            border-top: 5px solid var(--naranja-basket);
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php"><i class="bi bi-basketball me-2"></i><?php echo APP_NAME; ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#nosotros">Nosotros</a></li>
                    <li class="nav-item"><a class="nav-link" href="#servicios">Programas</a></li>
                    <li class="nav-item ms-lg-4"><a class="btn btn-outline-warning" href="login.php">Iniciar Sesión</a></li>
                    <li class="nav-item ms-lg-2"><a class="btn btn-warning" href="register.php">Registrarse</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" style="background-image: url('https://images.unsplash.com/photo-1515523110800-9415d13b84a8?q=80&w=1374&auto=format&fit=crop');">
                <div class="carousel-caption">
                    <h2>Entrena como un Profesional</h2>
                    <p>Nuestra plataforma conecta talentos con universidades y clubes profesionales.</p>
                </div>
            </div>
                <div class="carousel-item" style="background-image: url('https://images.unsplash.com/photo-1546519638-68e109498ffc?q=80&w=1490&auto=format&fit=crop');">
                    <div class="carousel-caption">
                        <h2>Scouting y Ojeadores</h2>
                        <p>Nuestra plataforma conecta talentos con universidades y clubes profesionales.</p>
                    </div>
                </div>
            
            <div class="carousel-item" style="background-image: url('https://images.unsplash.com/photo-1515523110800-9415d13b84a8?q=80&w=1374&auto=format&fit=crop');">
                <div class="carousel-caption">
                    <h2>Torneos y Competencias</h2>
                    <p><i class="bi bi-trophy me-2"></i> <?php echo APP_NAME; ?> organiza torneos regionales e internacionales para desarrollar el talento.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <section id="nosotros" class="container section-padding">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2 class="title-section">Sobre Nosotros</h2>
                <p>En **<?php echo APP_NAME; ?>**, Una plataforma que conecta talentos con universidades y clubes profesionales de baloncesto.</p>
                <a href="login.php" class="btn btn-dark btn-lg">Leer más</a>
            </div>
            <div class="col-md-6">
                <img src="https://images.unsplash.com/photo-1504450758481-7338eba7524a?q=80&w=1469&auto=format&fit=crop" alt="baloncesto" class="img-fluid rounded shadow shadow-lg">
            </div>
        </div>
    </section>

    <section id="servicios" class="bg-light section-padding">
        <div class="container text-center">
            <h2 class="title-section">Proximamente!!</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="p-4 bg-white rounded shadow-sm">
                        <i class="bi bi-trophy icon-box"></i>
                        <h3 class="bebas mt-3">Alto Rendimiento</h3>
                        <p>Entrenamiento físico y técnico personalizado para competidores élite.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="p-4 bg-white rounded shadow-sm">
                        <i class="bi bi-person-video3 icon-box"></i>
                        <h3 class="bebas mt-3">Análisis de Video</h3>
                        <p>Usamos tecnología avanzada para corregir tu mecánica de tiro y postura.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="p-4 bg-white rounded shadow-sm">
                        <i class="bi bi-geo-alt icon-box"></i>
                        <h3 class="bebas mt-3">Campamentos Verano</h3>
                        <p>Inmersión total en el mundo del baloncesto durante las vacaciones.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer text-center">
        <div class="container">
            <h2 class="bebas text-warning"><?php echo APP_NAME; ?></h2>
            <p>La victoria se construye en los entrenamientos.</p>
            <div class="fs-3 mb-3">
                <i class="bi bi-facebook mx-2"></i>
                <i class="bi bi-instagram mx-2"></i>
                <i class="bi bi-twitter-x mx-2"></i>
            </div>
            <hr class="bg-secondary">
            <p class="mb-0 small text-secondary">&copy; 2026 <?php echo APP_NAME; ?>. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
