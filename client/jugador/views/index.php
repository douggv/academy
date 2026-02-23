<?php 
include '../layouts/verificiacion.php';
?>

<?php
// Usamos el ID de sesión del jugador definido en verificar_jugador.php
$id_jugador = $_SESSION['id_jugador_sesion'];

// 1. Obtener datos personales y promedios generales
$query_atleta = $pdo->prepare("SELECT j.*, u.nombre_universidad,
    AVG(ri.puntos) as avg_puntos, AVG(ri.asistencias) as avg_asistencias, 
    AVG(ri.robos) as avg_robos, AVG(ri.rebotes) as avg_rebotes
    FROM jugadores j
    LEFT JOIN academias u ON j.id_universidad_fk = u.id_universidad
    LEFT JOIN resultados_individuales ri ON j.id_jugador = ri.id_jugador_fk
    WHERE j.id_jugador = :id
    GROUP BY j.id_jugador");
$query_atleta->execute(['id' => $id_jugador]);
$atleta = $query_atleta->fetch(PDO::FETCH_ASSOC);

// 2. Obtener Juegos donde participa su academia (Próximos y Pasados)
// Relacionamos juegos con academias para ver si el marcador ya existe
$query_juegos = $pdo->prepare("SELECT g.*, 
    ac_local.nombre_universidad as local, 
    ac_vis.nombre_universidad as visitante,
    ri.puntos, ri.asistencias, ri.robos, ri.rebotes
    FROM juegos g
    INNER JOIN academias ac_local ON g.id_academia_local = ac_local.id_universidad
    INNER JOIN academias ac_vis ON g.id_academia_visitante = ac_vis.id_universidad
    LEFT JOIN resultados_individuales ri ON (g.id_juego = ri.id_juego_fk AND ri.id_jugador_fk = :id_jugador)
    WHERE g.id_academia_local = :id_uni OR g.id_academia_visitante = :id_uni
    ORDER BY g.fecha_juego DESC");
$query_juegos->execute([
    'id_jugador' => $id_jugador,
    'id_uni' => $atleta['id_universidad_fk']
]);
$juegos = $query_juegos->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Hub - Hub de Atleta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root { --naranja: #ff6600; --dark: #121212; --glass: rgba(255, 255, 255, 0.9); }
        body { background: #f0f2f5; font-family: 'Poppins', sans-serif; }
        
        /* Navbar con estilo deportivo */
        .navbar-player { background: var(--dark); border-bottom: 3px solid var(--naranja); }
        
        .welcome-section { background: var(--dark); color: white; padding: 60px 0; border-radius: 0 0 50px 50px; margin-bottom: -50px; }
        
        .hub-card { border: none; border-radius: 20px; transition: 0.3s; background: white; height: 100%; }
        .hub-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        
        .icon-shape { width: 50px; height: 50px; background: #fff3e0; color: var(--naranja); display: flex; align-items: center; justify-content: center; border-radius: 12px; margin-bottom: 15px; }
        
        .tournament-badge { background: #e3f2fd; color: #0d47a1; font-weight: bold; border-radius: 50px; padding: 5px 15px; font-size: 0.75rem; }
        
        .stat-circle { width: 60px; height: 60px; border: 3px solid var(--naranja); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.2rem; }
    </style>
</head>
<body>

<nav class="navbar navbar-player navbar-dark py-3">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#"><i class="bi bi-basketball text-orange"></i> JUGADOR</a>
        <div class="d-flex align-items-center">
            <span class="text-white me-3 d-none d-md-inline">Hola, <strong><?= $nombre_jugador_sesion ?></strong></span>
            <a href="logout.php" class="btn btn-outline-light btn-sm rounded-pill px-3">Cerrar Cancha</a>
        </div>
    </div>
</nav>

<div class="welcome-section shadow">
    <div class="container d-flex align-items-center justify-content-center flex-column">
        <div class="mb-3">
            <img src="<?= $URL ?>/client/assets/img/jugadores/<?= $atleta['imagen_jugador'] ?>" 
                 class="rounded-circle border border-4 border-warning shadow" 
                 style="width: 120px; height: 120px; object-fit: cover;">
        </div>
        <h1 class="display-6 fw-bold text-uppercase"><?= $atleta['nombre_jugador'] ?></h1>
        <p class="badge bg-warning text-dark px-3"><?= $atleta['nombre_universidad'] ?></p>
    </div>
</div>

<div class="container mt-5">
    <div class="row g-4">
        
        <div class="col-md-4">
            <div class="card hub-card p-4 shadow-sm">
                <div class="icon-shape"><i class="bi bi-body-text fs-4"></i></div>
                <h5 class="fw-bold">Ficha Antropométrica</h5>
                <hr>
                <div class="row text-center">
                    <div class="col-6 mb-3">
                        <small class="text-muted d-block">Altura</small>
                        <span class="fw-bold fs-5"><?= $atleta['altura_jugador'] ?> m</span>
                    </div>
                    <div class="col-6 mb-3">
                        <small class="text-muted d-block">Peso</small>
                        <span class="fw-bold fs-5"><?= $atleta['peso_jugador'] ?> kg</span>
                    </div>
                    <div class="col-12">
                        <small class="text-muted d-block">Fecha Nacimiento</small>
                        <span class="fw-bold"><?= $atleta['fecha_nacimiento'] ?? 'No registrada' ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card hub-card p-4 shadow-sm">
                <h5 class="fw-bold mb-4"><i class="bi bi-graph-up-arrow text-warning"></i> Promedios de Temporada</h5>
                <div class="row g-3">
                    <div class="col-3 text-center">
                        <div class="stat-circle mx-auto"><?= round($atleta['avg_puntos'], 1) ?></div>
                        <small class="text-muted">Puntos</small>
                    </div>
                    <div class="col-3 text-center">
                        <div class="stat-circle mx-auto border-primary text-primary"><?= round($atleta['avg_asistencias'], 1) ?></div>
                        <small class="text-muted">Asistencias</small>
                    </div>
                    <div class="col-3 text-center">
                        <div class="stat-circle mx-auto border-info text-info"><?= round($atleta['avg_rebotes'], 1) ?></div>
                        <small class="text-muted">Rebotes</small>
                    </div>
                    <div class="col-3 text-center">
                        <div class="stat-circle mx-auto border-success text-success"><?= round($atleta['avg_robos'], 1) ?></div>
                        <small class="text-muted">Robos</small>
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card hub-card p-4 shadow-sm mb-5">
                <h5 class="fw-bold mb-4">Agenda de Competencia y Resultados</h5>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Fecha</th>
                                <th>Tipo</th>
                                <th>Encuentro / Marcador</th>
                                <th>Estado</th>
                                <th>Mi Aporte Individual</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($juegos as $juego): 
                                $hoy = date('Y-m-d');
                                $es_pasado = ($juego['fecha_juego'] < $hoy);
                            ?>
                            <tr>
                                <td><?= date('d/m/Y', strtotime($juego['fecha_juego'])) ?></td>
                                <td><span class="badge bg-secondary"><?= $juego['tipo_juego'] ?></span></td>
                                <td class="fw-bold">
                                    <?= $juego['local'] ?> 
                                    <span class="text-warning mx-2">
                                        <?= $es_pasado ? ($juego['puntos_local'] . " - " . $juego['puntos_visitante']) : "VS" ?>
                                    </span>
                                    <?= $juego['visitante'] ?>
                                </td>
                                <td>
                                    <?php if($es_pasado): ?>
                                        <span class="badge bg-success">FINALIZADO</span>
                                    <?php else: ?>
                                        <span class="badge bg-primary">PRÓXIMO</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($juego['puntos'] !== null): ?>
                                        <small class="text-muted">
                                            PTS: <strong><?= $juego['puntos'] ?></strong> | 
                                            AST: <strong><?= $juego['asistencias'] ?></strong> | 
                                            REB: <strong><?= $juego['rebotes'] ?></strong>
                                            ROB: <strong><?= $juego['robos'] ?></strong>
                                        </small>
                                    <?php else: ?>
                                        <span class="text-muted small">Sin datos registrados</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>