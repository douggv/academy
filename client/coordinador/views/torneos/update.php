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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Actualizar Juego</title>
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark fw-bold">
                    <i class="bi bi-pencil-square"></i> Actualizar Encuentro #<?php echo $id; ?>
                </div>
                <div class="card-body">
                    <form action="../../../../app/controllers/controllers_coordinador/torneos/update.php" method="POST">
                        <input type="hidden" name="id_juego" value="<?php echo $juego['id_juego']; ?>">

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Fecha del Juego</label>
                                <input type="date" name="fecha_juego" class="form-control" 
                                       value="<?php echo $juego['fecha_juego']; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Lugar / Sede</label>
                                <input type="text" name="lugar" class="form-control" 
                                       value="<?php echo htmlspecialchars($juego['lugar']); ?>" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label text-success fw-bold">Academia Local</label>
                                <select name="id_academia_local" class="form-select" required>
                                    <?php foreach ($academias as $ac): ?>
                                        <option value="<?php echo $ac['id_universidad']; ?>" 
                                            <?php echo ($ac['id_universidad'] == $juego['id_academia_local']) ? 'selected' : ''; ?>>
                                            <?php echo $ac['nombre_universidad']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-danger fw-bold">Academia Visitante</label>
                                <select name="id_academia_visitante" class="form-select" required>
                                    <?php foreach ($academias as $ac): ?>
                                        <option value="<?php echo $ac['id_universidad']; ?>" 
                                            <?php echo ($ac['id_universidad'] == $juego['id_academia_visitante']) ? 'selected' : ''; ?>>
                                            <?php echo $ac['nombre_universidad']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="index.php" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" name="actualizar" class="btn btn-warning fw-bold">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>



<?php include '../../layouts/parte2.php'; ?>  