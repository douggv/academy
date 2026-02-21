<?php include '../../layouts/verificacion.php'; ?>

<?php include '../../layouts/parte1.php'; ?> 


<?php

$id = $_GET['id'] ?? null;
if (!$id) { header("Location: index.php"); exit; }

// 1. Obtener los datos del juego actual
$stmt = $pdo->prepare("SELECT * FROM Juegos WHERE id_juego = ?");
$stmt->execute([$id]);
$juego = $stmt->fetch(PDO::FETCH_ASSOC);

// 2. Obtener la lista de academias para los selectores
$queryAcademias = $pdo->query("SELECT id_universidad, nombre_universidad FROM Academias ORDER BY nombre_universidad ASC");
$academias = $queryAcademias->fetchAll(PDO::FETCH_ASSOC);

if (!$juego) { echo "Juego no encontrado"; exit; }
?>
<?php
// obtenemos las universidades es decir inner join con academias para mostrar el nombre de las universidades en vez de los ids


$sql = "SELECT 
            j.id_juego,
            j.fecha_juego,
            j.lugar,
            j.puntos_local,      -- Nombres de columna corregidos
            j.puntos_visitante,
            j.ganador,
            j.id_academia_local,
            j.id_academia_visitante,
            a1.nombre_universidad AS local,
            a2.nombre_universidad AS visitante
        FROM Juegos j
        INNER JOIN Academias a1 ON j.id_academia_local = a1.id_universidad
        INNER JOIN Academias a2 ON j.id_academia_visitante = a2.id_universidad
        WHERE j.id_juego = ?"; // Consulta con los nombres de columna correctos
        

$query = $pdo->prepare($sql);
$query->execute([$id]);
$resultado = $query->fetch(PDO::FETCH_ASSOC);

?>



<style>
    .scoreboard-card {
        max-width: 700px;
        margin: 2rem auto;
        background: #1e293b;
        color: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 30px rgba(0,0,0,0.2);
    }
    .scoreboard-header {
        background: rgba(255,255,255,0.05);
        padding: 20px;
        text-align: center;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }
    .score-input {
        background: #0f172a;
        border: 2px solid #334155;
        color: #f59e0b;
        font-size: 3rem;
        font-weight: 800;
        text-align: center;
        border-radius: 12px;
        width: 120px;
        padding: 10px;
    }
    .score-input:focus {
        outline: none;
        border-color: #f59e0b;
        box-shadow: 0 0 15px rgba(245, 158, 11, 0.3);
    }
    .team-name {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 1.5rem;
        letter-spacing: 1px;
    }
    .vs-badge {
        background: #f59e0b;
        color: #1e293b;
        font-weight: 900;
        padding: 5px 15px;
        border-radius: 50px;
        margin: 0 20px;
    }
</style>

<div class="container mt-4">
    <div class="card shadow-sm border-0" style="border-radius: 15px;">
        <div class="card-header bg-dark text-white p-3" style="border-radius: 15px 15px 0 0;">
            <h4 class="mb-0 bebas"><i class="fas fa-trophy me-2 text-warning"></i> Registrar Resultado Final</h4>
        </div>
        <div class="card-body p-4">
            <form action="../../../../app/controllers/controllers_coordinador/torneos/marcador.php" method="POST">
                <input type="hidden" name="id_juego" value="<?php echo $resultado['id_juego']; ?>">

                <div class="row align-items-center text-center mb-4">
                    <div class="col-md-5">
                        <h5 class="fw-bold text-primary"><?php echo $resultado['local']; ?></h5>
                        <label class="small text-muted d-block mb-2">Puntos Local</label>
                        <input type="number" name="puntos_local" class="form-control form-control-lg text-center fw-bold" 
                               value="<?php echo $resultado['puntos_local'] ?? 0; ?>" required>
                    </div>

                    <div class="col-md-2">
                        <span class="badge bg-light text-dark fs-4">VS</span>
                    </div>

                    <div class="col-md-5">
                        <h5 class="fw-bold text-danger"><?php echo $resultado['visitante']; ?></h5>
                        <label class="small text-muted d-block mb-2">Puntos Visitante</label>
                        <input type="number" name="puntos_visitante" class="form-control form-control-lg text-center fw-bold" 
                               value="<?php echo $resultado['puntos_visitante'] ?? 0; ?>" required>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold"><i class="fas fa-crown text-warning"></i> Determinar Ganador</label>
                        <select name="ganador" class="form-select" required>
                            <option value="" disabled <?php echo empty($resultado['ganador']) ? 'selected' : ''; ?>>Seleccione quién ganó...</option>
                            
                            <option value="<?php echo $resultado['id_academia_local']; ?>" <?php echo ($resultado['ganador'] == $resultado['id_academia_local']) ? 'selected' : ''; ?>>
                                Ganador: <?php echo $resultado['local']; ?>
                            </option>
                            
                            <option value="<?php echo $resultado['id_academia_visitante']; ?>" <?php echo ($resultado['ganador'] == $resultado['id_academia_visitante']) ? 'selected' : ''; ?>>
                                Ganador: <?php echo $resultado['visitante']; ?>
                            </option>
                            
                            <option value="Empate" <?php echo ($resultado['ganador'] == 'Empate') ? 'selected' : ''; ?>>Empate</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 border-top pt-3">
                    <a href="index.php" class="btn btn-light border">Regresar</a>
                    <button type="submit" class="btn btn-dark px-4">
                        <i class="fas fa-save me-2"></i> Guardar Marcador
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>




<?php include '../../layouts/parte2.php'; ?>  