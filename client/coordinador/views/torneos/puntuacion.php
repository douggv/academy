<?php 
include '../../layouts/verificacion.php';
include '../../layouts/parte1.php'; 

// 1. Obtener ID del juego
$id_juego = $_GET['id'] ?? null;
if (!$id_juego) {
    echo "<div class='alert alert-danger'>ID de juego no proporcionado.</div>";
    exit;
}

// 2. Consultar datos básicos del juego y nombres de universidades
$sql_juego = "SELECT j.*, a1.nombre_universidad AS local, a2.nombre_universidad AS visitante 
              FROM Juegos j
              INNER JOIN Academias a1 ON j.id_academia_local = a1.id_universidad
              INNER JOIN Academias a2 ON j.id_academia_visitante = a2.id_universidad
              WHERE j.id_juego = ?";
$query_j = $pdo->prepare($sql_juego);
$query_j->execute([$id_juego]);
$info_juego = $query_j->fetch(PDO::FETCH_ASSOC);

// 3. Consultar jugadores LOCALES y sus estadísticas (si ya existen)
$sql_local = "SELECT jug.id_jugador, jug.nombre_jugador,
                     IFNULL(res.puntos, 0) as puntos,
                     IFNULL(res.asistencias, 0) as asistencias,
                     IFNULL(res.robos, 0) as robos,
                     IFNULL(res.rebotes, 0) as rebotes
              FROM jugadores jug
              LEFT JOIN Resultados_Individuales res ON jug.id_jugador = res.id_jugador_fk AND res.id_juego_fk = :id_juego
              WHERE jug.id_universidad_fk = :id_uni_local";
$query_l = $pdo->prepare($sql_local);
$query_l->execute(['id_juego' => $id_juego, 'id_uni_local' => $info_juego['id_academia_local']]);
$jugadores_local = $query_l->fetchAll(PDO::FETCH_ASSOC);

// 4. Consultar jugadores VISITANTES y sus estadísticas (si ya existen)
$sql_visitante = "SELECT jug.id_jugador, jug.nombre_jugador,
                        IFNULL(res.puntos, 0) as puntos,
                        IFNULL(res.asistencias, 0) as asistencias,
                        IFNULL(res.robos, 0) as robos,
                        IFNULL(res.rebotes, 0) as rebotes
                 FROM jugadores jug
                 LEFT JOIN Resultados_Individuales res ON jug.id_jugador = res.id_jugador_fk AND res.id_juego_fk = :id_juego
                 WHERE jug.id_universidad_fk = :id_uni_visitante";
$query_v = $pdo->prepare($sql_visitante);
$query_v->execute(['id_juego' => $id_juego, 'id_uni_visitante' => $info_juego['id_academia_visitante']]);
$jugadores_visitante = $query_v->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
    .stat-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        margin-bottom: 2rem;
    }
    .stat-input {
        width: 65px;
        text-align: center;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        padding: 5px;
        font-weight: 600;
        color: #1e293b;
    }
    .stat-input:focus {
        border-color: #3b82f6;
        outline: none;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    .team-header {
        padding: 15px 20px;
        border-bottom: 2px solid #f1f5f9;
        font-family: 'Bebas Neue', sans-serif;
        letter-spacing: 1px;
    }
    .table-stats thead th {
        font-size: 0.7rem;
        text-transform: uppercase;
        color: #64748b;
        background: #f8fafc;
        border: none;
    }
    .header-info {
        background: #1e293b;
        color: white;
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 25px;
    }
</style>

<div class="container-fluid">
    <div class="header-info d-flex justify-content-between align-items-center">
        <div>
            <h2 class="bebas mb-0">Estadísticas Detalladas</h2>
            <p class="mb-0 text-light opacity-75 small">
                <?php echo $info_juego['local']; ?> vs <?php echo $info_juego['visitante']; ?> | 
                <i class="fas fa-calendar-alt"></i> <?php echo date('d/m/Y', strtotime($info_juego['fecha_juego'])); ?>
            </p>
        </div>
        <div class="text-end">
            <span class="badge bg-warning text-dark px-3 py-2">MODO EDICIÓN</span>
        </div>
    </div>

    <form action="../../../../app/controllers/controllers_coordinador/torneos/guardar_puntuacion.php" method="POST">
        <input type="hidden" name="id_juego" value="<?php echo $id_juego; ?>">

        <div class="row">
            <div class="col-lg-6">
                <div class="stat-card">
                    <div class="team-header bg-primary text-white rounded-top">
                        <h4 class="mb-0"><i class="fas fa-home me-2"></i> <?php echo $info_juego['local']; ?></h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-stats mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">Jugador</th>
                                    <th class="text-center">PTS</th>
                                    <th class="text-center">AST</th>
                                    <th class="text-center">ROB</th>
                                    <th class="text-center">REB</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($jugadores_local as $j): ?>
                                <tr>
                                    <td class="ps-4 fw-bold small"><?php echo htmlspecialchars($j['nombre_jugador']); ?></td>
                                    <td class="text-center"><input type="number" name="stats[<?php echo $j['id_jugador']; ?>][pts]" value="<?php echo $j['puntos']; ?>" class="stat-input" min="0"></td>
                                    <td class="text-center"><input type="number" name="stats[<?php echo $j['id_jugador']; ?>][ast]" value="<?php echo $j['asistencias']; ?>" class="stat-input" min="0"></td>
                                    <td class="text-center"><input type="number" name="stats[<?php echo $j['id_jugador']; ?>][rob]" value="<?php echo $j['robos']; ?>" class="stat-input" min="0"></td>
                                    <td class="text-center"><input type="number" name="stats[<?php echo $j['id_jugador']; ?>][reb]" value="<?php echo $j['rebotes']; ?>" class="stat-input" min="0"></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="stat-card">
                    <div class="team-header bg-danger text-white rounded-top">
                        <h4 class="mb-0"><i class="fas fa-bus me-2"></i> <?php echo $info_juego['visitante']; ?></h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-stats mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">Jugador</th>
                                    <th class="text-center">PTS</th>
                                    <th class="text-center">AST</th>
                                    <th class="text-center">ROB</th>
                                    <th class="text-center">REB</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($jugadores_visitante as $j): ?>
                                <tr>
                                    <td class="ps-4 fw-bold small"><?php echo htmlspecialchars($j['nombre_jugador']); ?></td>
                                    <td class="text-center"><input type="number" name="stats[<?php echo $j['id_jugador']; ?>][pts]" value="<?php echo $j['puntos']; ?>" class="stat-input" min="0"></td>
                                    <td class="text-center"><input type="number" name="stats[<?php echo $j['id_jugador']; ?>][ast]" value="<?php echo $j['asistencias']; ?>" class="stat-input" min="0"></td>
                                    <td class="text-center"><input type="number" name="stats[<?php echo $j['id_jugador']; ?>][rob]" value="<?php echo $j['robos']; ?>" class="stat-input" min="0"></td>
                                    <td class="text-center"><input type="number" name="stats[<?php echo $j['id_jugador']; ?>][reb]" value="<?php echo $j['rebotes']; ?>" class="stat-input" min="0"></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center gap-3 mt-2 mb-5">
            <a href="index.php" class="btn btn-light border px-5 py-2 fw-bold">Cancelar</a>
            <button type="submit" class="btn btn-dark px-5 py-2 fw-bold shadow">
                <i class="fas fa-save me-2 text-warning"></i> Sincronizar Estadísticas
            </button>
        </div>
    </form>
</div>

<?php include '../../layouts/parte2.php'; ?>