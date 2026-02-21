<?php include '../../layouts/verificacion.php'; ?>

<?php include '../../layouts/parte1.php'; ?> 


<?php 
   $sql = "SELECT * FROM academias 
    ORDER BY id_universidad ASC";
    $query = $pdo->prepare($sql);
    $query->execute();
    $universidades = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include '../../../../alert.php'; ?> 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Registrar Nuevo Juego de Baloncesto</h4>
                </div>
                <div class="card-body">
                    <form action="../../../../app/controllers/controllers_coordinador/torneos/create.php" method="POST">
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="tipo_juego" class="form-label fw-bold">Tipo de Juego</label>
                                <select name="tipo_juego" id="tipo_juego" class="form-select" required>
                                    <option value="" selected disabled>Seleccione tipo...</option>
                                    <option value="Amistoso">Amistoso</option>
                                    <option value="Liga">Liga Universitaria</option>
                                    <option value="Torneo">Torneo Corto</option>
                                    <option value="3 vs 3">3 vs 3</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="fecha" class="form-label fw-bold">Fecha del Encuentro</label>
                                <input type="date" name="fecha" id="fecha" class="form-control" required>
                            </div>
                        </div>

                        <hr>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="id_academia_local" class="form-label text-success fw-bold">Academia Local</label>
                                <select name="id_academia_local" id="id_academia_local" class="form-select" required>
                                    <option value="" selected disabled>Elegir Local...</option>
                                    <?php foreach ($universidades as $academia): ?>
                                        <option value="<?php echo $academia['id_universidad']; ?>">
                                            <?php echo htmlspecialchars($academia['nombre_universidad']); ?> (<?php echo $academia['id_universidad']; ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="id_academia_visitante" class="form-label text-danger fw-bold">Academia Visitante</label>
                                <select name="id_academia_visitante" id="id_academia_visitante" class="form-select" required>
                                    <option value="" selected disabled>Elegir Visitante...</option>
                                    <?php foreach ($universidades as $academia): ?>
                                        <option value="<?php echo $academia['id_universidad']; ?>">
                                            <?php echo htmlspecialchars($academia['nombre_universidad']); ?> (<?php echo $academia['id_universidad']; ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="lugar" class="form-label fw-bold">Lugar / Sede del Juego</label>
                            <input type="text" name="lugar" id="lugar" class="form-control" placeholder="Ej: Cancha Central UC">
                        </div>

                        <div class="d-grid">
                            <button type="submit" name="registrar_juego" class="btn btn-primary btn-lg">
                                <i class="bi bi-trophy"></i> Registrar Encuentro
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.querySelector('form').onsubmit = function(e) {
    const local = document.getElementById('id_academia_local').value;
    const visitante = document.getElementById('id_academia_visitante').value;
    
    if (local === visitante) {
        e.preventDefault();
        alert("¡Error! La academia local no puede ser la misma que la visitante.");
    }
};
</script>




<?php include '../../layouts/parte2.php'; ?>  