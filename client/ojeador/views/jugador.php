
<?php include '../layouts/verificacion.php'; ?> 

<?php include '../layouts/parte1.php'; ?>    

<?php


// Validar que el ID llegue por la URL
if (isset($_GET['id'])) {
    $id_jugador = $_GET['id'];
    $id_universidad = $_GET['id_universidad'] ?? null;

    // Consulta con INNER JOIN a universidades y objetivos
    $query = $pdo->prepare("SELECT j.*, u.nombre_universidad, u.ubicacion, o.puntos, o.asistencias, o.rebotes, o.robos 
                            FROM jugadores j
                            INNER JOIN academias u ON j.id_universidad_fk = u.id_universidad
                            INNER JOIN objetivos o ON j.id_objetivo_fk = o.id_objetivo
                            WHERE j.id_jugador = :id");
    $query->bindParam(':id', $id_jugador);
    $query->execute();
    $jugador = $query->fetch(PDO::FETCH_ASSOC);

    if (!$jugador) {
        //header("Location: index.php");
        echo "Jugador no encontrado.";
        exit();
    }
} else {
    //header("Location: index.php");
    echo "ID de jugador no proporcionado.";
    exit();
}
?>
<link href="https://cdn.jsdelivr.net" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net">
    <style>
        :root { --naranja-basket: #ff6600; --azul-dark: #1a1a2e; }
        body { background-color: #f4f7f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .card-profile { border: none; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .header-profile { background: var(--azul-dark); color: white; padding: 40px 20px; text-align: center; }
        .img-jugador { width: 150px; height: 150px; object-fit: cover; border: 5px solid white; border-radius: 50%; margin-top: -75px; background: white; }
        .stat-box { background: #fff3e0; border-radius: 15px; padding: 15px; text-align: center; border: 1px solid #ffe0b2; }
        .stat-value { font-size: 1.5rem; font-weight: bold; color: var(--naranja-basket); }
        .label-custom { color: #666; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; }
    </style>


<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            
            <!-- Botón Volver -->
            <a href="index.php" class="btn btn-sm mb-3 fw-bold text-secondary">
                <i class="bi bi-arrow-left"></i> VOLVER AL LISTADO
            </a>

            <div class="card card-profile">
                <!-- Encabezado con Fondo Oscuro -->
                <div class="header-profile">
                    <h2 class="mb-0"><?= $jugador['nombre_jugador'] ?></h2>
                    <p class="text-white-50"><i class="bi bi-geo-alt"></i> <?= $jugador['nombre_universidad'] ?> - <?= $jugador['ubicacion'] ?></p>
                </div>

                <!-- Imagen Flotante -->
                <div class="text-center">
                    <img src="<?php echo $URL; ?>/client/assets/img/jugadores/<?php echo $jugador['imagen_jugador']; ?>" alt="Foto" class="img-jugador shadow">
                </div>

                <div class="card-body pt-4">
                    <!-- Información Básica -->
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

                    <!-- Sección de Objetivos / Estadísticas -->
                    <h5 class="text-center fw-bold mb-3" style="color: var(--azul-dark);">OBJETIVOS DE TEMPORADA</h5>
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

                <!-- Footer de la Tarjeta -->
                <div class="card-footer bg-light text-center py-3">
                    <small class="text-muted">ID Jugador: #<?= $jugador['id_jugador'] ?></small>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net"></script>



<?php include '../layouts/parte2.php'; ?>    