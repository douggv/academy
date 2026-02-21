    <?php include '../../layouts/verificacion.php'; ?>

<?php include '../../layouts/parte1.php'; ?>   
<?php 
    $id_jugador = $_GET['id'] ?? null;
    if ($id_jugador) {
        $sql = "SELECT * FROM jugadores
        inner join academias on jugadores.id_universidad_fk = academias.id_universidad
        WHERE id_jugador = :id_jugador";
        $query = $pdo->prepare($sql);
        $query->bindParam(':id_jugador', $id_jugador, PDO::PARAM_INT);
        $query->execute();
        $jugador = $query->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "Jugador no encontrado.";
        exit;
    }

?>
    
<style>
    :root {
        --dark-panel: #0f172a;
        --accent-orange: #f97316;
        --stats-bg: #f8fafc;
    }

    .scouting-card {
        background: #fff;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        max-width: 850px;
        margin: 2rem auto;
        overflow: hidden;
    }

    /* Cabecera Estilo Perfil */
    .scouting-header {
        background: var(--dark-panel);
        color: white;
        padding: 30px;
        display: flex;
        align-items: center;
        gap: 25px;
    }

    .img-container {
        width: 150px;
        height: 150px;
        border-radius: 8px;
        border: 3px solid var(--accent-orange);
        overflow: hidden;
        background: #1e293b;
    }

    .img-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .player-title h1 {
        font-family: 'Bebas Neue', cursive;
        font-size: 2.5rem;
        margin: 0;
        line-height: 1;
        color: var(--accent-orange);
    }

    .player-title p {
        font-size: 1.1rem;
        margin: 5px 0 0;
        opacity: 0.8;
    }

    /* Cuerpo de Datos Fijos */
    .scouting-content {
        padding: 25px;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        border-bottom: 1px solid #f1f5f9;
    }

    /* Bloque de Estadísticas */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        background: var(--stats-bg);
        padding: 20px;
    }

    .stat-box {
        text-align: center;
        border-right: 1px solid #e2e8f0;
    }

    .stat-box:last-child { border-right: none; }

    .stat-value {
        display: block;
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--dark-panel);
    }

    .stat-label {
        font-size: 0.7rem;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
    }

    .data-label {
        display: block;
        font-size: 0.75rem;
        color: #94a3b8;
        font-weight: 700;
        text-transform: uppercase;
    }

    .data-value {
        font-size: 1rem;
        font-weight: 600;
        color: #334155;
    }
</style>

<div class="container">
    <div class="scouting-card">
        <div class="scouting-header">
            <div class="img-container">
                <?php if (!empty($jugador['imagen_jugador'])): ?>
                    <img src="<?php echo $URL; ?>/client/assets/img/jugadores/<?php echo $jugador['imagen_jugador']; ?>" alt="Foto Jugador">
                <?php else: ?>
                    <div class="h-100 d-flex align-items-center justify-content-center">
                        <i class="fas fa-user-ninja fa-4x text-secondary"></i>
                    </div>
                <?php endif; ?>
            </div>
            <div class="player-title">
                <h1><?php echo $jugador['nombre_jugador']; ?></h1>
                <p><i class="fas fa-university me-2"></i><?php echo $jugador['nombre_universidad']; ?></p>
                <div class="mt-2">
                    <span class="badge bg-primary"><?php echo $jugador['email_jugador']; ?></span>
                </div>
            </div>
        </div>

        <div class="scouting-content">
            <div>
                <span class="data-label">Altura</span>
                <span class="data-value"><?php echo $jugador['altura_jugador'] ?? '--'; ?> m</span>
            </div>
            <div>
                <span class="data-label">Peso</span>
                <span class="data-value"><?php echo $jugador['peso_jugador'] ?? '--'; ?> kg</span>
            </div>
            <div>
                <span class="data-label">Estatus</span>
                <span class="data-value text-success">Competidor</span>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-box">
                <span class="stat-value"><?php echo $jugador['puntos'] ?? '0'; ?></span>
                <span class="stat-label">Puntos</span>
            </div>
            <div class="stat-box">
                <span class="stat-value"><?php echo $jugador['asistencias'] ?? '0'; ?></span>
                <span class="stat-label">Asistencias</span>
            </div>
            <div class="stat-box">
                <span class="stat-value"><?php echo $jugador['rebotes'] ?? '0'; ?></span>
                <span class="stat-label">Rebotes</span>
            </div>
            <div class="stat-box">
                <span class="stat-value"><?php echo $jugador['robos'] ?? '0'; ?></span>
                <span class="stat-label">Robos</span>
            </div>
        </div>
    </div>

    <div class="text-center mt-3">
        <button onclick="window.print();" class="btn btn-dark shadow-sm">
            <i class="fas fa-print me-2"></i> Imprimir Reporte de Jugador
        </button>
    </div>
</div>


<?php include '../../layouts/parte2.php'; ?>
