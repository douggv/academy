
<?php include '../layouts/verificacion.php'; ?> 
<?php include '../layouts/parte1.php'; ?>    
<?php include '../layouts/nav.php'; ?>

    
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

   <section id="nosotros" class="container section-padding">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2 class="title-section">Sobre Nosotros</h2>
                <p>En **<?php echo APP_NAME; ?>**, no solo formamos jugadores de baloncesto; formamos líderes. Fundada en 2010, nuestra academia ha sido el punto de partida para más de 500 atletas que ahora compiten en niveles colegiales y profesionales.</p>
                <p>Nuestra metodología combina el desarrollo técnico individual con la inteligencia táctica en equipo.</p>
                <button class="btn btn-dark btn-lg">Leer más</button>
            </div>
            <div class="col-md-6">
                <img src="https://images.unsplash.com/photo-1504450758481-7338eba7524a?q=80&w=1469&auto=format&fit=crop" alt="baloncesto" class="img-fluid rounded shadow shadow-lg">
            </div>
        </div>
    </section>

    <section id="servicios" class="bg-light section-padding">
        <div class="container text-center">
            <h2 class="title-section">Lo que ofrecemos</h2>
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

<?php include '../layouts/parte2.php'; ?>