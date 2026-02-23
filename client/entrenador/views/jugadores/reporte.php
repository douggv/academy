<?php 
include '../../layouts/verificacion.php'; 
include '../../layouts/parte1.php'; 



try {
    // Consulta avanzada para promedios
    $sql = "SELECT 
                j.id_jugador, j.nombre_jugador, j.email_jugador, j.imagen_jugador, 
                j.altura_jugador, j.peso_jugador,
                COUNT(ri.id_resultado) as partidos_jugados,
                SUM(ri.puntos) as total_puntos,
                SUM(ri.asistencias) as total_asistencias,
                SUM(ri.robos) as total_robos,
                SUM(ri.rebotes) as total_rebotes
            FROM jugadores j
            LEFT JOIN resultados_individuales ri ON j.id_jugador = ri.id_jugador_fk
            GROUP BY j.id_jugador
            ORDER BY total_puntos DESC";

    $query = $pdo->prepare($sql);
    $query->execute();
    $jugadores = $query->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error en el reporte: " . $e->getMessage();
}
$ruta_fotos = "../../../../public/assets/img/jugadores/";
?>

<style>
    .player-card {
        background: #fff;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        border: 1px solid #e0e0e0;
    }
    .player-image-container {
        width: 140px;
        height: 140px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .stat-box {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 10px;
        text-align: center;
        border-bottom: 3px solid #dee2e6;
    }
    .stat-value {
        font-size: 1.4rem;
        font-weight: 800;
        display: block;
        color: #1a1a1a;
    }
    .stat-label {
        font-size: 0.65rem;
        text-transform: uppercase;
        color: #6c757d;
        letter-spacing: 1px;
    }
    @media print {
        .no-print { display: none !important; }
        .player-card { break-inside: avoid; border: 1px solid #000 !important; }
    }
</style>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-end mb-5 border-bottom pb-3">
        <div>
            <h1 class="display-5 fw-bold text-dark mb-0">Scouting Report</h1>
            <p class="text-primary fw-bold mb-0">ANÁLISIS ESTADÍSTICO POR PARTIDO</p>
        </div>
        <button onclick="window.print();" class="btn btn-dark btn-lg px-4 no-print shadow">
            <i class="bi bi-printer me-2"></i> Generar PDF
        </button>
    </div>

    <div class="row">
        <?php foreach ($jugadores as $jugador): 
            $pj = $jugador['partidos_jugados'];
            $divisor = ($pj > 0) ? $pj : 1;
            
            // Promedios
            $ppp = number_format($jugador['total_puntos'] / $divisor, 1);
            $app = number_format($jugador['total_asistencias'] / $divisor, 1);
            $rpp = number_format($jugador['total_robos'] / $divisor, 1);
            $rebpp = number_format($jugador['total_rebotes'] / $divisor, 1);
        ?>
        <div class="col-12 mb-4">
            <div class="player-card shadow-sm p-4">
                <div class="row align-items-center">
                    <div class="col-auto">

                        <img src="<?php echo $URL; ?>/client/assets/img/jugadores/<?php echo $jugador['imagen_jugador']; ?>" 
                             class="player-image-container" 
                             alt="<?= $jugador['nombre_jugador'] ?>">
                    </div>

                    <div class="col-md-3">
                        <h3 class="fw-bold mb-1"><?= htmlspecialchars($jugador['nombre_jugador']) ?></h3>
                        <p class="text-muted mb-2 small"><i class="bi bi-envelope"></i> <?= $jugador['email_jugador'] ?></p>
                        <div class="d-flex gap-2 mb-2">
                            <span class="badge bg-dark">PJ: <?= $pj ?></span>
                            <span class="badge bg-secondary"><?= $jugador['altura_jugador'] ?> m</span>
                            <span class="badge bg-secondary"><?= $jugador['peso_jugador'] ?> kg</span>
                        </div>
                    </div>

                    <div class="col-md-7">
                        <div class="row g-3">
                            <div class="col-3">
                                <div class="stat-box" style="border-color: #0d6efd;">
                                    <span class="stat-label">Puntos</span>
                                    <span class="stat-value"><?= $ppp ?></span>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="stat-box" style="border-color: #198754;">
                                    <span class="stat-label">Asistencias</span>
                                    <span class="stat-value"><?= $app ?></span>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="stat-box" style="border-color: #dc3545;">
                                    <span class="stat-label">Robos</span>
                                    <span class="stat-value"><?= $rpp ?></span>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="stat-box" style="border-color: #ffc107;">
                                    <span class="stat-label">Rebotes</span>
                                    <span class="stat-value"><?= $rebpp ?></span>
                                </div>
                            </div>
                        </div>
                        <p class="text-center mt-3 mb-0 text-muted small fw-bold">PROMEDIO POR ENCUENTRO DISPUTADO</p>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include '../../layouts/parte2.php'; ?>

