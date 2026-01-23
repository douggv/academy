<?php include '../../layouts/verificacion.php'; ?>

<?php include '../../layouts/parte1.php'; ?> 
<?php include '../../../../app/controllers/controllers_entrenador/jugadores/read.php'; ?> 




<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Plantilla de Jugadores</h2>
        <span class="badge bg-dark">Universidad ID: <?= htmlspecialchars($usuarioLogueado['id_universidad_fk']) ?></span>
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover align-middle">
            <thead class="table-primary">
                <tr>
                    <th>Nombre del Jugador</th>
                    <th>Email</th>
                    <th class="text-center">Altura (cm)</th>
                    <th class="text-center">Peso (kg)</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($jugadores) > 0): ?>
                    <?php foreach ($jugadores as $jugador): ?>
                        <tr>
                            <td class="fw-bold text-uppercase"><?= htmlspecialchars($jugador['nombre_jugador']) ?></td>
                            <td><?= htmlspecialchars($jugador['email_jugador']) ?></td>
                            <td class="text-center">
                                <span class="badge bg-info text-dark"><?= htmlspecialchars($jugador['altura_jugador']) ?> m</span>
                            </td>
                            <td class="text-center"><?= htmlspecialchars($jugador['peso_jugador']) ?> kg</td>
                            <td class="text-center">
                                <a href="read.php?id=<?= $jugador['id_jugador'] ?>" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-person-bounding-box"></i> Ver Detalles
                                </a>
                                <a href="update.php?id=<?= $jugador['id_jugador'] ?>" class="btn btn-outline-warning btn-sm">
                                    <i class="bi bi-person-bounding-box"></i> Actualizar
                                </a>                                
                                <a href="delete.php?id=<?= $jugador['id_jugador'] ?>" class="btn btn-outline-danger btn-sm ms-2">
                                    <i class="bi bi-trash"></i> Eliminar
                                </a>
                                
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted">No hay jugadores registrados para esta universidad.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>



<?php include '../../layouts/parte2.php'; ?>  