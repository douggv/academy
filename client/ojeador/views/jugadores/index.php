
<?php include '../../layouts/verificacion.php'; ?> 

<?php include '../../layouts/parte1.php'; ?>    
<?php include '../../layouts/nav.php'; ?>
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

<?php 
    $id_universidad = $_GET['universidad'] ?? null;
    if ($id_universidad) {
        $sql = "SELECT * FROM jugadores WHERE id_universidad_fk = :id_universidad ORDER BY nombre_jugador ASC";
        $query = $pdo->prepare($sql);
        $query->bindParam(':id_universidad', $id_universidad, PDO::PARAM_INT);
        $query->execute();
        $jugadores = $query->fetchAll(PDO::FETCH_ASSOC);
    } else {
        // Redirigir si no se proporciona ID
        header("Location: ../universidades.php");
        exit();
    }
?>  

<section class="container section-padding">


    <h2 class="title-section text-center bebas">Jugadores de la Universidad</h2>
    <div class="row">
        <?php foreach ($jugadores as $jugador): ?>
            <article class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0" style="border-top: 4px solid var(--naranja-basket) !important;">
                    <div class="text-center p-3">

                        <img src="<?php echo $URL; ?>/client/assets/img/jugadores/<?php echo $jugador['imagen_jugador']; ?>" 
                             class="card-img-top img-fluid" 
                             alt="<?php echo htmlspecialchars($jugador['nombre_jugador']); ?>"
                             style="max-height: 200px; object-fit: contain;">
                    </div>

                    <div class="card-body text-center">
                        <h3 class="bebas h4 mb-2"><?php echo htmlspecialchars($jugador['nombre_jugador']); ?></h3>
                        
                        <p class="card-text text-muted small">
                            <i class="fas fa-map-marker-alt"></i> 
                            <?php 
                                // Ajusta 'ciudad' y 'estado' según los nombres reales de tus columnas
                                echo htmlspecialchars($jugador['ciudad'] ?? '') . ", " . htmlspecialchars($jugador['estado'] ?? ''); 
                            ?>
                        </p>
                    </div>
                    
                    <div class="card-footer bg-white border-0 pb-4">
                        <a href="#" 
                           class="btn w-100 fw-bold" 
                           style="background-color: var(--naranja-basket); color: white; border-radius: 25px;">
                           VER DETALLES
                        </a>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>
<?php include '../../layouts/parte2.php'; ?>    