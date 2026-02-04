<?php include '../../layouts/verificacion.php'; ?>

<?php include '../../layouts/parte1.php'; ?>    

<?php 
   // Tu código SQL original
   $sql = "SELECT * FROM jugadores 
    inner join academias on jugadores.id_universidad_fk = academias.id_universidad   
    ORDER BY id_universidad ASC";
    $query = $pdo->prepare($sql);
    $query->execute();
    $jugadores = $query->fetchAll(PDO::FETCH_ASSOC);

    $sql2 = "SELECT * FROM usuarios where id_rol_fk = 3";
    $query2 = $pdo->prepare($sql2);
    $query2->execute();
    $entrenadores = $query2->fetchAll(PDO::FETCH_ASSOC);

    // AGRUPACIÓN: Creamos un array donde la llave es el ID de la universidad
    $bloques_universidad = [];
    foreach ($jugadores as $j) {
        $bloques_universidad[$j['id_universidad']]['nombre'] = $j['nombre_universidad'];
        $bloques_universidad[$j['id_universidad']]['jugadores'][] = $j;
    }
?>

<style>
    /* Contenedor de bloque por Universidad */
    .uni-block {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        margin-bottom: 35px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    /* Encabezado Principal */
    .uni-block-header {
        background: var(--admin-sidebar);
        padding: 15px 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .uni-block-header h4 {
        color: #fb923c; /* Naranja suave */
        margin: 0;
        font-size: 1.25rem;
        text-transform: uppercase;
    }

    /* Franja del Entrenador */
    .coach-strip {
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        padding: 12px 25px;
        display: flex;
        align-items: center;
    }

    .coach-label {
        font-size: 0.7rem;
        font-weight: 800;
        color: #64748b;
        text-transform: uppercase;
        margin-right: 15px;
        padding: 2px 8px;
        border: 1px solid #cbd5e1;
        border-radius: 4px;
    }

    .coach-name {
        color: #1e293b;
        font-weight: 600;
        font-size: 0.95rem;
    }

    /* Tabla de Integrantes */
    .table-members {
        width: 100%;
        margin-bottom: 0;
    }

    .table-members thead th {
        background: #ffffff;
        color: #94a3b8;
        font-size: 0.75rem;
        text-transform: uppercase;
        padding: 15px 25px;
        border-bottom: 2px solid #f1f5f9;
    }

    .table-members tbody td {
        padding: 12px 25px;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .player-tag {
        display: inline-flex;
        align-items: center;
        font-weight: 500;
    }

    .status-dot {
        height: 8px;
        width: 8px;
        background-color: #10b981;
        border-radius: 50%;
        margin-right: 10px;
    }
</style>


<div id="content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="bebas">Estructura de Academias</h2>
            <span class="text-muted">Total Universidades: <?php echo count($bloques_universidad); ?></span>
        </div>

        <?php foreach ($bloques_universidad as $id_uni => $datos): ?>
            
            <div class="uni-block">
                <div class="uni-block-header">
                    <h4 class="bebas"><i class="fas fa-university me-2"></i> <?php echo $datos['nombre']; ?></h4>
                    <span class="badge bg-dark border border-secondary">ID REF: <?php echo $id_uni; ?></span>
                </div>

                <div class="coach-strip">
                    <span class="coach-label">Coach</span>
                    <span class="coach-name">
                        <i class="fas fa-user-tie me-2 text-primary"></i>
                        <?php 
                            // Buscamos al entrenador que corresponda a esta universidad
                            // Nota: Asegúrate que en tu tabla 'usuarios' o 'academias' exista un campo para vincularlos.
                            // Aquí buscaremos un entrenador cuyo ID coincida con la lógica de tu negocio.
                            echo $entrenadores[0]['nombre_usuario']; // Ejemplo: Tomando el primero por ahora
                        ?>
                    </span>
                </div>

                <div class="table-responsive">
                    <table class="table table-members">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Altura</th>
                                <th>Peso</th>
                                <th class="text-end">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($datos['jugadores'] as $jugador): ?>
                                <tr>
                                    <td>
                                        <div class="player-tag">
                                            <div class="status-dot"></div>
                                            <strong><?php echo $jugador['nombre_jugador'] ?? 'Sin Nombre'; ?></strong>
                                        </div>      
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border">
                                            <?php echo $jugador['altura_jugador'] ?? '---'; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border">
                                            <?php echo $jugador['peso_jugador'] ?? '---'; ?>
                                        </span>
                                    </td>
                                    <td class="text-muted small"><?php echo $jugador['email_jugador'] ?? 'n/a'; ?></td>
                                    <td class="text-end">
                                        <a href="jugador.php?id=<?php echo $jugador['id_jugador']; ?>" class="btn btn-sm btn-outline-dark">
                                            <i class="fas fa-file-invoice"></i> Ver Perfil
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>



<?php include '../../layouts/parte2.php'; ?>
