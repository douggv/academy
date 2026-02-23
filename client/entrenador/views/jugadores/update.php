
<?php include '../../layouts/verificacion.php'; ?>




<?php 


// 1. Obtener los datos actuales del jugador
$id_jugador_get = $_GET['id'] ?? null;

$sql = "SELECT * FROM jugadores WHERE id_jugador = :id_jugador AND id_universidad_fk = :id_uni";
$query = $pdo->prepare($sql);
$query->bindParam(':id_jugador', $id_jugador_get, PDO::PARAM_INT);
$query->bindParam(':id_uni', $usuarioLogueado['id_universidad_fk'], PDO::PARAM_INT);
$query->execute();
$jugador = $query->fetch(PDO::FETCH_ASSOC);

if (!$jugador) {
    header("Location: index.php");
    exit();
}

include '../../layouts/parte1.php'; 
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-header bg-success text-white py-3">
                    <h4 class="mb-0"><i class="bi bi-pencil-square"></i> Editar Datos del Jugador</h4>
                </div>
                <div class="card-body p-4">
                    <form action="<?php echo $URL ?>/app/controllers/controllers_entrenador/jugadores/update.php" method="POST" enctype="multipart/form-data">
                        
                        <input type="hidden" name="id_jugador" value="<?php echo $id_jugador_get; ?>">

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Nombre Completo</label>
                                    <input type="text" name="nombre_jugador" class="form-control" 
                                           value="<?php echo $jugador['nombre_jugador']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Email</label>
                                    <input type="email" name="email_jugador" class="form-control" 
                                           value="<?php echo $jugador['email_jugador']; ?>" required>
                                </div>
                            </div>

                            <div class="col-md-4 text-center">
                                <label class="form-label fw-bold">Foto Actual</label>
                                <div class="mb-2">
                                    <?php if(!empty($jugador['imagen_jugador'])): ?>
                                        <img src="<?php echo $URL; ?>/client/assets/img/jugadores/<?php echo $jugador['imagen_jugador']; ?>" width="100" class="img-thumbnail">
                                    <?php else: ?>
                                        <i class="bi bi-person-square text-muted" style="font-size: 3rem;"></i>
                                    <?php endif; ?>
                                </div>
                                <input type="file" name="imagen_jugador" class="form-control form-control-sm">
                                <small class="text-muted small">Subir nueva para cambiar</small>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Altura (cm)</label>
                                <input type="text" 
                                    name="altura_jugador" 
                                    class="form-control" 
                                    value="<?php echo $jugador['altura_jugador']; ?>" 
                                    pattern="^[0-9,]+$" 
                                    title="Solo se permiten números y comas (,)" 
                                    oninput="this.value = this.value.replace(/[^0-9,]/g, '')"
                                    required>
                                <div class="form-text text-muted">Use solo números y comas.</div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Peso (kg)</label>
                                <input type="number" step="0.1" name="peso_jugador" class="form-control" 
                                       value="<?php echo $jugador['peso_jugador']; ?>" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Nacimiento</label>
                                <input type="date" name="fecha_nacimiento" class="form-control" 
                                       value="<?php echo $jugador['fecha_nacimiento']; ?>" required>
                            </div>
                        </div>
                        
                       

                        <hr>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="index.php" class="btn btn-secondary px-4">Cancelar</a>
                            <button type="submit" class="btn btn-success px-4">
                                <i class="bi bi-arrow-repeat"></i> Actualizar Jugador
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../../layouts/parte2.php'; ?>