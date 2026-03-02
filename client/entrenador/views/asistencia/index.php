<?php 
include '../../layouts/verificacion.php'; 
// verificacion.php ya trae la conexión $pdo y la variable $id_universidad_entrenador
?>
<?php include '../../../../alert.php'; ?> 

<?php include '../../layouts/parte1.php'; ?> 

<div class="container-fluid mt-4">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Historial de Entrenamientos</h1>
        <a href="create.php" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm"></i> Registrar Nueva Asistencia
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Registros de la Academia</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="tabla_entrenamientos" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nro</th>
                            <th>Fecha y Hora</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Preparamos la consulta con PDO para mayor seguridad
                        $sql = "SELECT * FROM asistencia 
                                WHERE id_universidad_fk = :id_uni 
                                ORDER BY fecha_hora_asistencia DESC";
                        
                        $query = $pdo->prepare($sql);
                        $query->bindParam(':id_uni', $id_universidad_entrenador);
                        $query->execute();
                        $entrenamientos = $query->fetchAll(PDO::FETCH_ASSOC);

                        $contador = 0;
                        foreach($entrenamientos as $entrenamiento){
                            $contador++;
                            $id_asistencia = $entrenamiento['id_asistencia'];
                        ?>
                            <tr>
                                <td><?php echo $contador; ?></td>
                                <td><?php echo date('d/m/Y H:i', strtotime($entrenamiento['fecha_hora_asistencia'])); ?></td>
                                <td><?php echo $entrenamiento['descripcion']; ?></td>
                                
                            </tr>
                        <?php 
                        } 
                        if($contador == 0){
                            echo "<tr><td colspan='4' class='text-center'>No se encontraron registros</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include '../../layouts/parte2.php'; ?>