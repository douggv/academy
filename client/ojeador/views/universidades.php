
<?php include '../layouts/verificacion.php'; ?> 
<?php include '../layouts/parte1.php'; ?>    
<?php include '../layouts/nav.php'; ?>

<?php 
    $sql = "SELECT * FROM academias ORDER BY nombre_universidad ASC";
    $query = $pdo->prepare($sql);
    $query->execute();
    $universidades = $query->fetchAll(PDO::FETCH_ASSOC);


?>
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


<section class="container section-padding">
    <h2 class="title-section text-center bebas">Nuestras Universidades</h2>
    <div class="row">
        <?php foreach ($universidades as $uni): ?>
            <article class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0" style="border-top: 4px solid var(--naranja-basket) !important;">
                    
                    <div class="text-center p-3">
                        <img src="<?php echo $URL; ?>/public/images/universidades/<?php echo $uni['imagen']; ?>" 
                             class="card-img-top img-fluid" 
                             alt="<?php echo htmlspecialchars($uni['nombre_universidad']); ?>"
                             style="max-height: 150px; object-fit: contain;">
                    </div>

                    <div class="card-body text-center">
                        <h3 class="bebas h4 mb-2"><?php echo htmlspecialchars($uni['nombre_universidad']); ?></h3>
                        
                        <p class="card-text text-muted small">
                            <i class="fas fa-map-marker-alt"></i> 
                            <?php 
                                // Ajusta 'ciudad' y 'estado' según los nombres reales de tus columnas
                                echo htmlspecialchars($uni['ciudad'] ?? '') . ", " . htmlspecialchars($uni['estado'] ?? ''); 
                            ?>
                        </p>
                    </div>
                    
                    <div class="card-footer bg-white border-0 pb-4">
                        <a href="jugadores.php?universidad=<?php echo $uni['id_universidad']; ?>" 
                           class="btn w-100 fw-bold" 
                           style="background-color: var(--naranja-basket); color: white; border-radius: 25px;">
                           VER JUGADORES
                        </a>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>


<?php include '../layouts/parte2.php'; ?>