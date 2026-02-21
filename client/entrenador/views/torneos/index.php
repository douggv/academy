<?php 
include '../../layouts/verificacion.php';
include '../../layouts/parte1.php'; 

// Suponiendo que la variable $id_universidad_entrenador ya viene de tu sesión o controlador
// Si no, asegúrate de tenerla disponible. Ejemplo: $id_universidad_entrenador = $usuario['id_universidad_fk'];

$sql_juegos = "SELECT 
                j.id_juego,
                j.fecha_juego,
                j.lugar,
                j.puntos_local,
                j.puntos_visitante,
                a1.nombre_universidad AS local,
                a2.nombre_universidad AS visitante,
                a1.id_universidad AS id_local
              FROM Juegos j
              INNER JOIN Academias a1 ON j.id_academia_local = a1.id_universidad
              INNER JOIN Academias a2 ON j.id_academia_visitante = a2.id_universidad
              WHERE j.id_academia_local = :id_uni OR j.id_academia_visitante = :id_uni
              ORDER BY j.fecha_juego DESC";

$query = $pdo->prepare($sql_juegos);
$query->execute(['id_uni' => $usuarioLogueado['id_universidad_fk']]);
$juegos = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
    .tournament-card {
        border: none;
        border-radius: 15px;
        transition: transform 0.3s ease;
        background: #fff;
    }
    .tournament-card:hover {
        transform: translateY(-5px);
    }
    .date-badge {
        background: #f1f5f9;
        color: #475569;
        font-weight: 700;
        border-radius: 8px;
        padding: 8px 12px;
        display: inline-block;
    }
    .vs-circle {
        width: 40px;
        height: 40px;
        background: #1e293b;
        color: #fbbf24;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 900;
        font-size: 0.8rem;
        margin: 0 15px;
        border: 3px solid #fff;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .team-name {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 1.2rem;
        color: #1e293b;
    }
    .my-team {
        color: #0ea5e9; /* Resalta el equipo del entrenador */
        font-weight: bold;
    }
</style>

<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="bebas"><i class="fas fa-calendar-check me-2 text-primary"></i> Calendario de Torneos</h2>
            <p class="text-muted">Visualiza los próximos encuentros y resultados de tu academia.</p>
        </div>
    </div>

    <div class="row">
        <?php if(empty($juegos)): ?>
            <div class="col-12 text-center py-5">
                <img src="../../../../client/assets/img/empty-calendar.svg" alt="No hay juegos" style="width: 150px; opacity: 0.5;">
                <p class="mt-3 text-muted">Aún no hay juegos programados para tu universidad.</p>
            </div>
        <?php else: ?>
            <?php foreach($juegos as $j): ?>
                <div class="col-md-6 col-xl-4 mb-4">
                    <div class="tournament-card shadow-sm p-3">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="date-badge small">
                                <i class="far fa-calendar-alt me-1"></i> 
                                <?php echo date('d M, Y', strtotime($j['fecha_juego'])); ?>
                            </div>
                            <span class="badge <?php echo (strtotime($j['fecha_juego']) < time()) ? 'bg-secondary' : 'bg-success'; ?>">
                                <?php echo (strtotime($j['fecha_juego']) < time()) ? 'Finalizado' : 'Próximo'; ?>
                            </span>
                        </div>

                        <div class="d-flex align-items-center justify-content-center py-3">
                            <div class="text-center flex-fill">
                                <span class="team-name <?php echo ($j['id_local'] == $id_universidad_entrenador) ? 'my-team' : ''; ?>">
                                    <?php echo $j['local']; ?>
                                </span>
                            </div>
                            
                            <div class="vs-circle">VS</div>
                            
                            <div class="text-center flex-fill">
                                <span class="team-name <?php echo ($j['id_local'] != $id_universidad_entrenador) ? 'my-team' : ''; ?>">
                                    <?php echo $j['visitante']; ?>
                                </span>
                            </div>
                        </div>

                        <div class="border-top pt-3 mt-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted"><i class="fas fa-map-marker-alt me-1"></i> <?php echo $j['lugar']; ?></small>
                                <?php if(strtotime($j['fecha_juego']) < time()): ?>
                                    <span class="fw-bold"><?php echo $j['puntos_local']; ?> - <?php echo $j['puntos_visitante']; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php include '../../layouts/parte2.php'; ?>