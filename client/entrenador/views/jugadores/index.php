<?php include '../../layouts/verificacion.php'; ?>

<?php include '../../layouts/parte1.php'; ?> 
<?php include '../../../../app/controllers/controllers_entrenador/jugadores/read.php'; ?> 

<?php
    // Solo inicia sesión si no hay una activa
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if(isset($_SESSION['mensaje'])):
        $mensaje = $_SESSION['mensaje'];
        // Si no existe 'color', usamos 'alert-info' por defecto
        $color = isset($_SESSION['color']) ? $_SESSION['color'] : 'alert-info';
?>
    <div id="alerta-flotante" 
         class="alert <?= $color ?> alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 shadow-lg" 
         style="z-index: 9999; min-width: 320px; text-align: center;" 
         role="alert">
        
        <i class="bi bi-info-circle me-2"></i> <strong><?= $mensaje ?></strong>
        
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <script>
        setTimeout(function() {
            const alerta = document.getElementById('alerta-flotante');
            if (alerta) {
                alerta.classList.remove('show');
                setTimeout(() => alerta.remove(), 500);
            }
        }, 3000);
    </script>

<?php 
    unset($_SESSION['mensaje']);
    unset($_SESSION['color']);
    endif; 
?>

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
                    <th class="text-center">Altura (m)</th>
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