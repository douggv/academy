<?php include '../../layouts/verificacion.php'; ?>

<?php include '../../layouts/parte1.php'; ?> 
<?php include '../../../../alert.php'; ?> 

<?php
// Consulta con los nombres de columna correctos: fecha_juego y lugar
$sql = "SELECT 
            j.id_juego,
            j.fecha_juego,          -- Corregido: antes era j.fecha
            j.lugar,
            j.fecha_creacion,   -- Incluida por si quieres mostrarla
            a1.nombre_universidad AS local,
            a2.nombre_universidad AS visitante
        FROM Juegos j
        INNER JOIN Academias a1 ON j.id_academia_local = a1.id_universidad
        INNER JOIN Academias a2 ON j.id_academia_visitante = a2.id_universidad
        ORDER BY j.fecha_juego DESC";

$query = $pdo->prepare($sql);
$query->execute(); // Esta es la línea 22 que te daba el error
$juegos = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary"><i class="bi bi-trophy-fill"></i> Lista de Encuentros</h2>
        <a href="create.php" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-lg"></i> Registrar Nuevo Juego
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Fecha</th>
                        <th>Encuentro (Local vs Visitante)</th>
                        <th class="text-center">Detalles</th>
                        <th class="text-center pe-4">Acciones</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($juegos)): ?>
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">No hay juegos registrados actualmente.</td>
                        </tr>
                    <?php endif; ?>

                    <?php foreach($juegos as $juego): ?>
                        
                        <tr>
                            <td class="ps-4">
                                <span class="fw-bold"><?php echo date('d/m/Y', strtotime($juego['fecha_juego'])); ?></span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-primary me-2">L</span> 
                                    <span class="fw-semibold"><?php echo htmlspecialchars($juego['local']); ?></span>
                                    <span class="mx-3 text-muted">vs</span>
                                    <span class="badge bg-danger me-2">V</span> 
                                    <span class="fw-semibold"><?php echo htmlspecialchars($juego['visitante']); ?></span>
                                </div>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-secondary" type="button" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#detalle-<?php echo $juego['id_juego']; ?>" 
                                        aria-expanded="false">
                                    <i class="bi bi-eye"></i> Ver más
                                </button>
                            </td>
                            <td class="text-end pe-4">
                                <div class="btn-group shadow-sm">
                                    <?php 
                                    // Capturamos la fecha actual y la del juego
                                    $hoy = date('Y-m-d');
                                    $fecha_juego = $juego['fecha_juego'];

                                    // LÓGICA CONTRARIA: Si la fecha del juego es MAYOR a hoy (es decir, el partido es mañana o después)
                                    // se muestran Actualizar y Eliminar.
                                    if ($fecha_juego > $hoy): ?>
                                        <a href="update.php?id=<?php echo $juego['id_juego']; ?>" class="btn btn-white btn-sm border">
                                            <i class="bi bi-pencil-square text-primary">Actualizar</i>
                                        </a>
                                        
                                    <?php endif; ?>

                                    <?php 
                                    // ESTA ES TU LÓGICA ACTUAL (La que ya funciona):
                                    // Si la fecha es hoy o ya pasó, se muestran los resultados.
                                    if ($fecha_juego <= $hoy): ?>
                                        <a href="resultados.php?id=<?php echo $juego['id_juego']; ?>" class="btn btn-white btn-sm border">
                                            <i class="bi bi-bar-chart-line text-success">Resultados</i>
                                        </a>
                                        <a href="puntuacion.php?id=<?php echo $juego['id_juego']; ?>" class="btn btn-white btn-sm border">
                                            <i class="bi bi-bar-chart-line text-success">puntuacion</i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>

                        <tr class="collapse bg-light" id="detalle-<?php echo $juego['id_juego']; ?>">
                            <td colspan="4" class="p-0">
                                <div class="p-4 border-start border-primary border-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p class="mb-1 text-muted small uppercase fw-bold">Ubicación / Sede</p>
                                            <p class="mb-0"><i class="bi bi-geo-alt-fill text-danger"></i> <?php echo htmlspecialchars($juego['lugar']); ?></p>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="mb-1 text-muted small uppercase fw-bold">Fecha de Registro</p>
                                            <p class="mb-0"><i class="bi bi-clock-history"></i> <?php echo date('d/m/Y H:i', strtotime($juego['fecha_creacion'])); ?></p>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="mb-1 text-muted small uppercase fw-bold">ID del Encuentro</p>
                                            <p class="mb-0 text-monospace">#JUE-<?php echo str_pad($juego['id_juego'], 5, "0", STR_PAD_LEFT); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-group shadow-sm">
                                    <?php if (strtotime($juego['fecha_juego']) < time()): ?>
                                        <a href="reporte_fiba.php?id=<?php echo $juego['id_juego']; ?>" class="btn btn-white btn-sm border" target="_blank">
                                            <i class="bi bi-file-earmark-pdf text-danger"></i> Reporte FIBA
                                        </a>
                                    <?php endif; ?>
                                </div>
                             </td>
                            
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function confirmarEliminar(id) {
    if(confirm('¿Seguro que deseas eliminar este encuentro?')) {
        window.location.href = '../../../../app/controllers/controllers_coordinador/torneos/delete.php?id=' + id;
    }
}
</script>


<?php include '../../layouts/parte2.php'; ?>  