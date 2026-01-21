
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