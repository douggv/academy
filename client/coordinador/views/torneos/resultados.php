<?php include '../../layouts/verificacion.php'; ?>
<?php include '../../layouts/parte1.php'; ?> 

<?php
$id = $_GET['id'] ?? null;
if (!$id) { header("Location: index.php"); exit; }

// 1. Obtener los datos del juego actual para verificar estado
$sql = "SELECT 
            j.id_juego,
            j.fecha_juego,
            j.lugar,
            j.puntos_local,
            j.puntos_visitante,
            j.ganador,
            j.id_academia_local,
            j.id_academia_visitante,
            a1.nombre_universidad AS local,
            a2.nombre_universidad AS visitante
        FROM Juegos j
        INNER JOIN Academias a1 ON j.id_academia_local = a1.id_universidad
        INNER JOIN Academias a2 ON j.id_academia_visitante = a2.id_universidad
        WHERE j.id_juego = ?";

$query = $pdo->prepare($sql);
$query->execute([$id]);
$resultado = $query->fetch(PDO::FETCH_ASSOC);

if (!$resultado) { echo "Juego no encontrado"; exit; }

// LOGICA DE BLOQUEO: Si ganador no es NULL, el juego ya se realizó
$bloqueado = !is_null($resultado['ganador']);
?>

<style>
    /* ... (Tus estilos se mantienen iguales) */
    .btn-locked { cursor: not-allowed; opacity: 0.7; }
</style>

<div class="container mt-4">
    <div class="card shadow-sm border-0" style="border-radius: 15px;">
        <div class="card-header bg-dark text-white p-3" style="border-radius: 15px 15px 0 0;">
            <h4 class="mb-0 bebas">
                <i class="fas fa-trophy me-2 text-warning"></i> 
                <?php echo $bloqueado ? "Resultado Finalizado" : "Registrar Resultado Final"; ?>
            </h4>
        </div>
        <div class="card-body p-4">
            
            <?php if ($bloqueado): ?>
                <div class="alert alert-warning border-0 shadow-sm d-flex align-items-center mb-4">
                    <i class="fas fa-lock me-3 fs-4"></i>
                    <div>
                        <strong>Marcador Protegido:</strong> Este juego ya tiene un resultado registrado y no puede ser modificado.
                    </div>
                </div>
            <?php endif; ?>

            <form action="../../../../app/controllers/controllers_coordinador/torneos/marcador.php" method="POST">
                <input type="hidden" name="id_juego" value="<?php echo $resultado['id_juego']; ?>">

                <div class="row align-items-center text-center mb-4">
                    <div class="col-md-5">
                        <h5 class="fw-bold text-primary"><?php echo $resultado['local']; ?></h5>
                        <label class="small text-muted d-block mb-2">Puntos Local</label>
                        <input type="number" name="puntos_local" class="form-control form-control-lg text-center fw-bold" 
                               value="<?php echo $resultado['puntos_local'] ?? 0; ?>" 
                               required <?php echo $bloqueado ? 'readonly' : ''; ?>>
                    </div>

                    <div class="col-md-2">
                        <span class="badge bg-light text-dark fs-4">VS</span>
                    </div>

                    <div class="col-md-5">
                        <h5 class="fw-bold text-danger"><?php echo $resultado['visitante']; ?></h5>
                        <label class="small text-muted d-block mb-2">Puntos Visitante</label>
                        <input type="number" name="puntos_visitante" class="form-control form-control-lg text-center fw-bold" 
                               value="<?php echo $resultado['puntos_visitante'] ?? 0; ?>" 
                               required <?php echo $bloqueado ? 'readonly' : ''; ?>>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold"><i class="fas fa-crown text-warning"></i> Ganador Registrado</label>
                        <select name="ganador" class="form-select" required <?php echo $bloqueado ? 'disabled' : ''; ?>>
                            <option value="" disabled <?php echo empty($resultado['ganador']) ? 'selected' : ''; ?>>Seleccione quién ganó...</option>
                            
                            <option value="<?php echo $resultado['id_academia_local']; ?>" <?php echo ($resultado['ganador'] == $resultado['id_academia_local']) ? 'selected' : ''; ?>>
                                Ganador: <?php echo $resultado['local']; ?>
                            </option>
                            
                            <option value="<?php echo $resultado['id_academia_visitante']; ?>" <?php echo ($resultado['ganador'] == $resultado['id_academia_visitante']) ? 'selected' : ''; ?>>
                                Ganador: <?php echo $resultado['visitante']; ?>
                            </option>
                            
                            <option value="Empate" <?php echo ($resultado['ganador'] == 'Empate') ? 'selected' : ''; ?>>Empate</option>
                        </select>
                        
                        <?php if($bloqueado): ?>
                            <input type="hidden" name="ganador" value="<?php echo $resultado['ganador']; ?>">
                        <?php endif; ?>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 border-top pt-3">
                    <a href="index.php" class="btn btn-light border">Regresar</a>
                    
                    <?php if (!$bloqueado): ?>
                        <button type="submit" class="btn btn-dark px-4">
                            <i class="fas fa-save me-2"></i> Guardar Marcador
                        </button>
                    <?php else: ?>
                        <button type="button" class="btn btn-secondary px-4 btn-locked" disabled>
                            <i class="fas fa-check-double me-2"></i> Resultado Cerrado
                        </button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../../layouts/parte2.php'; ?>