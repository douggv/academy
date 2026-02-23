<?php include '../../layouts/verificacion.php'; ?>

<?php include '../../layouts/parte1.php'; ?> 
<?php 
    $id_jugador_get = $_GET['id'] ?? null;

    // Obtener datos del jugador a eliminar
    $sql = "SELECT * FROM jugadores WHERE id_jugador = :id_jugador AND id_universidad_fk = :id_uni";
    $query = $pdo->prepare($sql);
    $query->bindParam(':id_jugador', $id_jugador_get, PDO::PARAM_INT);
    $query->bindParam(':id_uni', $usuarioLogueado['id_universidad_fk'], PDO::PARAM_INT);
    $query->execute();
    $jugadores = $query->fetch(PDO::FETCH_ASSOC);

    if (!$jugadores) {
        // Si no se encuentra el jugador, redirigir o mostrar un mensaje de error
        header("Location: index.php");
        exit();
    }
?>



<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow border-0 border-danger"> <div class="card-header bg-danger text-white text-center py-3">
                    <h4 class="mb-0"><i class="bi bi-trash"></i> ¿Eliminar este Jugador?</h4>
                </div>
                <div class="card-body p-4">
                    <form action="<?php echo $URL ?>/app/controllers/controllers_entrenador/jugadores/delete.php" method="POST">
                        
                        <input type="hidden" name="id_jugador" value="<?php echo $id_jugador_get; ?>">

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Nombre Completo</label>
                                    <input type="text" value="<?php echo $jugadores['nombre_jugador']; ?>" class="form-control bg-light" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Email</label>
                                    <input type="email" value="<?php echo $jugadores['email_jugador']; ?>" class="form-control bg-light" readonly>
                                </div>
                            </div>

                            <div class="col-md-4 text-center">
                                <label class="form-label fw-bold">Foto Actual</label>
                                <div class="p-2 border rounded bg-light">
                                    <?php if(!empty($jugadores['imagen_jugador'])): ?>
                                        <img src="<?php echo $URL; ?>/client/assets/img/jugadores/<?php echo $jugadores['imagen_jugador']; ?>" width="100%" class="img-fluid rounded">
                                    <?php else: ?>
                                        <i class="bi bi-person-bounding-box" style="font-size: 3rem;"></i>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Altura (cm)</label>
                                <input type="text" value="<?php echo $jugadores['altura_jugador']; ?>" class="form-control bg-light" readonly>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Peso (kg)</label>
                                <input type="text" value="<?php echo $jugadores['peso_jugador']; ?>" class="form-control bg-light" readonly>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label fw-bold">Nacimiento</label>
                                <input type="date" value="<?php echo $jugadores['fecha_nacimiento']; ?>" class="form-control bg-light" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 d-grid mb-2">
                                <a href="index.php" class="btn btn-secondary btn-lg">Cancelar</a>
                            </div>
                            <div class="col-md-6 d-grid mb-2">
                                <button type="submit" class="btn btn-danger btn-lg">
                                    <i class="bi bi-trash"></i> Eliminar Definitivamente
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include '../../layouts/parte2.php'; ?>  