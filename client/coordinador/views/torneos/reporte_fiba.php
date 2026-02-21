<?php
include '../../../../app/config.php';
$id_juego = $_GET['id'];

// 1. Consulta extendida para incluir logos y nombres limpios
$sql_juego = "SELECT j.*, 
              a1.nombre_universidad AS local, a1.imagen AS imagen_local,
              a2.nombre_universidad AS visitante, a2.imagen AS imagen_visitante,
              (SELECT nombre_universidad FROM Academias WHERE id_universidad = j.ganador) as nombre_ganador
              FROM Juegos j
              INNER JOIN Academias a1 ON j.id_academia_local = a1.id_universidad
              INNER JOIN Academias a2 ON j.id_academia_visitante = a2.id_universidad
              WHERE j.id_juego = ?";
$query_j = $pdo->prepare($sql_juego);
$query_j->execute([$id_juego]);
$juego = $query_j->fetch(PDO::FETCH_ASSOC);

// 2. Obtener stats (tu función actual está perfecta)
function obtenerStatsJugadores($pdo, $id_juego, $id_universidad) {
    $sql = "SELECT jug.nombre_jugador, jug.imagen_jugador, ri.* FROM Resultados_Individuales ri
            INNER JOIN jugadores jug ON ri.id_jugador_fk = jug.id_jugador
            WHERE ri.id_juego_fk = ? AND jug.id_universidad_fk = ?
            ORDER BY ri.puntos DESC"; // Ordenar por puntos da más nivel al reporte
    $query = $pdo->prepare($sql);
    $query->execute([$id_juego, $id_universidad]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

$stats_local = obtenerStatsJugadores($pdo, $id_juego, $juego['id_academia_local']);
$stats_visitante = obtenerStatsJugadores($pdo, $id_juego, $juego['id_academia_visitante']);
?>



<style>
    body { background-color: #f4f7f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
    .report-container { max-width: 1000px; margin: 30px auto; background: white; border-radius: 15px; overflow: hidden; }
    
    /* Header Estilo Marcador */
    .header-scoreboard {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        color: white; padding: 40px; text-align: center; position: relative;
    }
    .team-logo { width: 80px; height: 80px; object-fit: contain; filter: drop-shadow(0 0 10px rgba(255,255,255,0.2)); }
    .score-display { font-size: 4.5rem; font-weight: 900; color: #fbbf24; margin: 0 30px; line-height: 1; }
    .vs-label { font-size: 1.2rem; color: #64748b; font-weight: bold; text-transform: uppercase; }
    
    /* Estilo de Tablas */
    .table-fiba { border-collapse: separate; border-spacing: 0 8px; width: 100%; }
    .table-fiba thead th { 
        background: #f8fafc; color: #64748b; text-transform: uppercase; 
        font-size: 0.75rem; border: none; padding: 12px;
    }
    .table-fiba tbody tr { background: white; transition: all 0.2s; box-shadow: 0 2px 4px rgba(0,0,0,0.02); }
    .player-img { width: 35px; height: 35px; border-radius: 50%; object-fit: cover; margin-right: 10px; border: 2px solid #e2e8f0; }
    .stat-val { font-weight: 700; color: #1e293b; }
    .bg-local { border-left: 5px solid #3b82f6; }
    .bg-visitante { border-left: 5px solid #ef4444; }
</style>

<div class="report-container shadow-lg">
    <div class="header-scoreboard">
        <div class="d-flex justify-content-center align-items-center">
            <div class="text-center">
                <img src="../../../../public/images/universidades/<?php echo $juego['imagen_local']; ?>" class="team-logo mb-2">
                <h4 class="mb-0 text-uppercase"><?php echo $juego['local']; ?></h4>
            </div>
            
            <div class="score-display"><?php echo $juego['puntos_local']; ?></div>
            <div class="vs-label">Final</div>
            <div class="score-display"><?php echo $juego['puntos_visitante']; ?></div>
            
            <div class="text-center">
                <img src="../../../../public/images/universidades/<?php echo $juego['imagen_visitante']; ?>" class="team-logo mb-2">
                <h4 class="mb-0 text-uppercase"><?php echo $juego['visitante']; ?></h4>
            </div>
        </div>
        <div class="mt-4">
            <span class="badge bg-warning text-dark px-3 py-2 fs-6">
                <i class="fas fa-crown me-1"></i> GANADOR: <?php echo $juego['nombre_ganador'] ?? 'Empate'; ?>
            </span>
        </div>
        <p class="text-muted mt-3 mb-0 small"><?php echo $juego['lugar']; ?> | <?php echo date('d M, Y', strtotime($juego['fecha_juego'])); ?></p>
    </div>

    <div class="p-4">
        <div class="row">
            <div class="col-lg-6">
                <h5 class="fw-bold mb-3 d-flex align-items-center">
                    <span class="p-2 bg-primary rounded me-2"></span> Box Score Local
                </h5>
                <table class="table-fiba">
                    <thead>
                        <tr>
                            <th>Jugador</th>
                            <th class="text-center">PTS</th>
                            <th class="text-center">REB</th>
                            <th class="text-center">AST</th>
                            <th class="text-center">ROB</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($stats_local as $s): ?>
                        <tr class="bg-local">
                            <td class="p-3 d-flex align-items-center">
                                <img src="../../../../client/assets/img/jugadores/<?php echo $s['imagen_jugador']; ?>" class="player-img">
                                <span class="small fw-semibold"><?php echo $s['nombre_jugador']; ?></span>
                            </td>
                            <td class="text-center stat-val"><?php echo $s['puntos']; ?></td>
                            <td class="text-center text-muted"><?php echo $s['rebotes']; ?></td>
                            <td class="text-center text-muted"><?php echo $s['asistencias']; ?></td>
                            <td class="text-center text-muted"><?php echo $s['robos']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="col-lg-6">
                <h5 class="fw-bold mb-3 d-flex align-items-center">
                    <span class="p-2 bg-danger rounded me-2"></span> Box Score Visitante
                </h5>
                <table class="table-fiba">
                    <thead>
                        <tr>
                            <th>Jugador</th>
                            <th class="text-center">PTS</th>
                            <th class="text-center">REB</th>
                            <th class="text-center">AST</th>
                            <th class="text-center">ROB</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($stats_visitante as $s): ?>
                        <tr class="bg-visitante">
                            <td class="p-3 d-flex align-items-center">
                                <img src="../../../../client/assets/img/jugadores/<?php echo $s['imagen_jugador']; ?>" class="player-img">
                                <span class="small fw-semibold"><?php echo $s['nombre_jugador']; ?></span>
                            </td>
                            <td class="text-center stat-val"><?php echo $s['puntos']; ?></td>
                            <td class="text-center text-muted"><?php echo $s['rebotes']; ?></td>
                            <td class="text-center text-muted"><?php echo $s['asistencias']; ?></td>
                            <td class="text-center text-muted"><?php echo $s['robos']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="bg-light p-3 text-center border-top">
        <button class="btn btn-dark btn-sm me-2" onclick="window.print()">
            <i class="fas fa-print"></i> Imprimir Planilla
        </button>
        <p class="text-muted small mt-2 mb-0">Reporte oficial generado el <?php echo date('d/m/Y H:i'); ?></p>
    </div>
</div>
