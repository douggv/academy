<?php include '../layouts/verificacion.php'; ?> 
<?php include '../layouts/parte1.php'; ?>    

<?php
// Validar que el ID llegue por la URL
if (isset($_GET['id'])) {
    $id_jugador = $_GET['id'];
    $id_universidad = $_GET['id_universidad'] ?? null;

    // Consulta con INNER JOIN y SUBQUERIE para contar partidos jugados
    $query = $pdo->prepare("SELECT j.*, u.nombre_universidad, u.ubicacion, o.puntos_o, o.asistencias_o, o.rebotes_o, o.robos_o,
                            (SELECT COUNT(*) FROM resultados_individuales ri WHERE ri.id_jugador_fk = j.id_jugador) as partidos_totales
                            FROM jugadores j
                            INNER JOIN academias u ON j.id_universidad_fk = u.id_universidad
                            INNER JOIN objetivos o ON j.id_objetivo_fk = o.id_objetivo
                            WHERE j.id_jugador = :id");
    $query->bindParam(':id', $id_jugador);
    $query->execute();
    $jugador = $query->fetch(PDO::FETCH_ASSOC);

    if (!$jugador) {
        echo "Jugador no encontrado.";
        exit();
    }
} else {
    echo "ID de jugador no proporcionado.";
    exit();
}
?>

<style>
    :root { --naranja-basket: #ff6600; --azul-dark: #1a1a2e; }
    body { background-color: #f4f7f6; font-family: 'Segoe UI', sans-serif; }
    
    .card-profile { 
        border: none; 
        border-radius: 20px; 
        box-shadow: 0 10px 30px rgba(0,0,0,0.1); 
        background-color: white;
        position: relative;
        margin-top: 40px; /* Un poco más de margen para no pegar al borde superior */
    }

    .header-profile { 
        background: var(--azul-dark); 
        color: white; 
        padding: 60px 20px 80px 20px; /* Padding extra para que la imagen no tape el nombre */
        text-align: center; 
        border-radius: 20px 20px 0 0;
    }

    .img-container {
        position: relative;
        margin-top: -75px; 
        z-index: 10;
    }

    .img-jugador { 
        width: 150px; 
        height: 150px; 
        object-fit: cover; 
        border: 6px solid white; 
        border-radius: 50%; 
        background: white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .stat-box { 
        background: #fff3e0; 
        border-radius: 15px; 
        padding: 10px; 
        text-align: center; 
        border: 1px solid #ffe0b2; 
        height: 100%; /* Para que todas midan lo mismo */
    }

    .stat-value { font-size: 1.4rem; font-weight: bold; color: var(--naranja-basket); }
    .label-custom { color: #666; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px; }
    
    .badge-partidos { 
        position: absolute; 
        top: 15px; 
        right: 15px; 
        background: rgba(255,102,0,0.2); 
        color: #ffb380; 
        border: 1px solid #ff6600; 
        padding: 4px 12px; 
        border-radius: 50px; 
        font-weight: bold; 
        font-size: 0.7rem; 
    }

    /* --- MEDIA QUERIES PARA CELULARES --- */
    @media (max-width: 576px) {
        .header-profile {
            padding: 70px 10px 60px 10px;
        }

        .header-profile h2 {
            font-size: 1.5rem; /* Texto más pequeño en móvil */
        }

        .img-jugador {
            width: 120px; /* Imagen más pequeña para que no ocupe toda la pantalla */
            height: 120px;
            margin-top: -10px; /* Ajuste para que no suba demasiado */
        }

        .img-container {
            margin-top: -60px;
        }

        .badge-partidos {
            position: relative; /* En móviles deja de flotar y se pone arriba del nombre */
            top: 0;
            right: 0;
            display: inline-block;
            margin-bottom: 15px;
        }

        .stat-value {
            font-size: 1.1rem; /* Números un poco más pequeños */
        }

        .label-custom {
            font-size: 0.55rem;
        }

        /* Cambiamos a 2 columnas en móvil para que no se vea tan apretado */
        .col-3 {
            width: 50% !important;
            margin-bottom: 10px;
        }
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            
            <a href="index.php" class="btn btn-sm mb-3 fw-bold text-secondary">
                <i class="bi bi-arrow-left"></i> VOLVER AL LISTADO
            </a>

            <div class="card card-profile">
                <div class="header-profile position-relative">
                    <div class="badge-partidos">
                        <?= $jugador['partidos_totales'] ?> PARTIDOS JUGADOS
                    </div>
                    <h2 class="mb-0"><?= $jugador['nombre_jugador'] ?></h2>
                    <p class="text-white-50"><i class="bi bi-geo-alt"></i> <?= $jugador['nombre_universidad'] ?> - <?= $jugador['ubicacion'] ?></p>
                </div>

                <div class="text-center">
                    <img style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%; border: 5px solid white;" src="<?php echo $URL; ?>/client/assets/img/jugadores/<?php echo $jugador['imagen_jugador']; ?>" alt="Foto" class="img-jugador shadow">
                </div>

                <div class="card-body pt-4">
                    <div class="row text-center mb-4">
                        <div class="col-4 border-end">
                            <div class="label-custom">Altura</div>
                            <div class="fw-bold"><?= $jugador['altura_jugador'] ?> m</div>
                        </div>
                        <div class="col-4 border-end">
                            <div class="label-custom">Peso</div>
                            <div class="fw-bold"><?= $jugador['peso_jugador'] ?> kg</div>
                        </div>
                        <div class="col-4">
                            <div class="label-custom">Contacto</div>
                            <div class="small fw-bold text-truncate px-1"><?= $jugador['email_jugador'] ?></div>
                        </div>
                    </div>

                    <hr class="text-muted">

                    <h5 class="text-center fw-bold mb-3" style="color: var(--azul-dark);">Promedio de Estadísticas</h5>
                    
                    <div class="row g-3">
                        <div class="col-3">
                            <div class="stat-box">
                                <div class="label-custom" style="font-size: 0.6rem;">PUNTOS</div>
                                <div class="stat-value"><?= $jugador['puntos'] ?></div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="stat-box">
                                <div class="label-custom" style="font-size: 0.6rem;">ASIST.</div>
                                <div class="stat-value"><?= $jugador['asistencias'] ?></div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="stat-box">
                                <div class="label-custom" style="font-size: 0.6rem;">REB.</div>
                                <div class="stat-value"><?= $jugador['rebotes'] ?></div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="stat-box">
                                <div class="label-custom" style="font-size: 0.6rem;">ROBOS</div>
                                <div class="stat-value"><?= $jugador['robos'] ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-light text-center py-3">
                    <small class="text-muted">ID Jugador: #<?= $jugador['id_jugador'] ?></small>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../layouts/parte2.php'; ?>