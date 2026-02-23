<?php include '../../layouts/verificacion.php'; ?>

<?php include '../../layouts/parte1.php'; ?> 

<?php 


// 2. SEGUNDO: Captura de datos y lógica de la base de datos
$id_jugador_get = $_GET['id'] ?? null;

// Consultar datos
$sql = "SELECT * FROM jugadores WHERE id_jugador = :id_jugador AND id_universidad_fk = :id_uni";
$query = $pdo->prepare($sql);
$query->bindParam(':id_jugador', $id_jugador_get, PDO::PARAM_INT);
$query->bindParam(':id_uni', $usuarioLogueado['id_universidad_fk'], PDO::PARAM_INT);
$query->execute();
$jugadores = $query->fetch(PDO::FETCH_ASSOC);

// 3. TERCERO: La validación crítica. 
// Como aquí aún no se ha cargado parte1.php, el header funcionará sin errores.
if (!$jugadores) {
    header("Location: index.php");
    exit();
}

// 4. CUARTO: Ahora sí, empezamos a imprimir el HTML cargando el layout

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="mb-0"><i class="bi bi-person-lines-fill"></i> Detalles del Jugador</h4>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <?php if(!empty($jugadores['imagen_jugador'])): ?>
                                <img src="<?php echo $URL; ?>/client/assets/img/jugadores/<?php echo $jugadores['imagen_jugador']; ?>" 
                                     class="img-fluid rounded border shadow-sm mb-3">
                            <?php else: ?>
                                <i class="bi bi-person-circle text-muted" style="font-size: 6rem;"></i>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-8">
                            <table class="table table-hover">
                                <tr>
                                    <th class="text-muted" style="width: 35%;">Nombre:</th>
                                    <td class="fw-bold"><?php echo $jugadores['nombre_jugador']; ?></td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Email:</th>
                                    <td><?php echo $jugadores['email_jugador']; ?></td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Altura:</th>
                                    <td><?php echo $jugadores['altura_jugador']; ?> cm</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Peso:</th>
                                    <td><?php echo $jugadores['peso_jugador']; ?> kg</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Nacimiento:</th>
                                    <td><?php echo date('d/m/Y', strtotime($jugadores['fecha_nacimiento'])); ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="text-end mt-4">
                        <a href="index.php" class="btn btn-secondary px-4">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<?php include '../../layouts/parte2.php'; ?> 