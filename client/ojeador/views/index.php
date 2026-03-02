
<?php include '../layouts/verificacion.php'; ?> 
<?php include '../layouts/parte1.php'; ?>    
<?php include '../layouts/nav.php'; ?>

    
<style>
    :root {
        --naranja-basket: #ff6600;
        --negro-pro: #1a1a1a;
    }

    body { 
        font-family: 'Poppins', sans-serif; 
        overflow-x: hidden; /* Evita scroll horizontal innecesario */
    }
    .bebas { font-family: 'Bebas Neue', cursive; }

    /* Navbar personalizada */
    .navbar {
        background-color: var(--negro-pro);
        border-bottom: 3px solid var(--naranja-basket);
    }
    .navbar-brand { font-family: 'Bebas Neue'; font-size: 1.8rem; color: var(--naranja-basket) !important; }
    
    /* Carrusel Adaptativo */
    .carousel-item {
        height: 70vh; /* Bajamos un poco la altura para móviles */
        min-height: 350px;
        background: no-repeat center center scroll;
        background-size: cover;
    }
    
    .carousel-caption {
        background: rgba(0, 0, 0, 0.7);
        padding: 1.5rem;
        border-radius: 10px;
        bottom: 15%;
        left: 5%;
        right: 5%;
    }

    /* Fuentes Responsivas con Media Queries */
    .carousel-caption h2 { font-family: 'Bebas Neue'; font-size: 2.5rem; color: var(--naranja-basket); }
    .title-section { font-family: 'Bebas Neue'; font-size: 2.5rem; margin-bottom: 20px; }

    @media (min-width: 768px) {
        .carousel-item { height: 85vh; }
        .carousel-caption h2 { font-size: 4.5rem; }
        .title-section { font-size: 3.5rem; }
        .carousel-caption { bottom: 20%; padding: 25px; }
    }

    /* Secciones */
    .section-padding { padding: 60px 0; }
    @media (min-width: 992px) {
        .section-padding { padding: 100px 0; }
    }

    .icon-box { color: var(--naranja-basket); font-size: 3.5rem; }

    /* Estilos extras para Cards */
    .service-card {
        transition: transform 0.3s ease;
        height: 100%; /* Para que todas las columnas midan lo mismo */
    }
    .service-card:hover {
        transform: translateY(-10px);
    }

    .footer {
        background-color: var(--negro-pro);
        color: white;
        padding: 50px 0 30px 0;
        border-top: 5px solid var(--naranja-basket);
    }
</style>


<section id="nosotros" class="container section-padding">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 text-center text-lg-start">
                <h2 class="title-section">Sobre Nosotros</h2>
                <p class="lead fw-normal">En **<?php echo APP_NAME; ?>**, no solo formamos jugadores de baloncesto; formamos líderes.</p>
                <p>Fundada en 2010, nuestra academia ha sido el punto de partida para más de 500 atletas que ahora compiten en niveles colegiales y profesionales. Nuestra metodología combina el desarrollo técnico individual con la inteligencia táctica en equipo.</p>
                <button class="btn btn-dark btn-lg px-5 mt-3">Leer más</button>
            </div>
            <div class="col-lg-6">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1504450758481-7338eba7524a?q=80&w=1469&auto=format&fit=crop" 
                         alt="Entrenamiento Baloncesto" 
                         class="img-fluid rounded-4 shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <section id="servicios" class="bg-light section-padding">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="title-section">Lo que ofrecemos</h2>
                <p class="text-muted">Programas diseñados para llevar tu juego al siguiente nivel</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="p-4 bg-white rounded-4 shadow-sm text-center service-card border-bottom border-4 border-warning">
                        <i class="bi bi-trophy icon-box"></i>
                        <h3 class="bebas mt-3">Alto Rendimiento</h3>
                        <p class="mb-0">Entrenamiento físico y técnico personalizado para competidores élite.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="p-4 bg-white rounded-4 shadow-sm text-center service-card border-bottom border-4 border-warning">
                        <i class="bi bi-person-video3 icon-box"></i>
                        <h3 class="bebas mt-3">Análisis de Video</h3>
                        <p class="mb-0">Usamos tecnología avanzada para corregir tu mecánica de tiro y postura.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mx-auto">
                    <div class="p-4 bg-white rounded-4 shadow-sm text-center service-card border-bottom border-4 border-warning">
                        <i class="bi bi-geo-alt icon-box"></i>
                        <h3 class="bebas mt-3">Campamentos Verano</h3>
                        <p class="mb-0">Inmersión total en el mundo del baloncesto durante las vacaciones.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container text-center">
            <h2 class="bebas text-warning h1 mb-3"><?php echo APP_NAME; ?></h2>
            <p class="mb-4 fs-5 italic">"La victoria se construye en los entrenamientos."</p>
            <div class="d-flex justify-content-center gap-4 fs-2 mb-4">
                <a href="#" class="text-white hover-orange"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-white hover-orange"><i class="bi bi-instagram"></i></a>
                <a href="#" class="text-white hover-orange"><i class="bi bi-twitter-x"></i></a>
            </div>
            <hr class="bg-secondary opacity-25">
            <p class="mb-0 small text-secondary">&copy; 2026 <?php echo APP_NAME; ?>. Todos los derechos reservados.</p>
        </div>
    </footer>

<?php include '../layouts/parte2.php'; ?>