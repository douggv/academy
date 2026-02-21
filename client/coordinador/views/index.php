<?php include '../layouts/verificacion.php'; ?>

<?php include '../layouts/parte1.php'; ?>    
<?php 
    // realizamos la consulta sql para contar el numero de jugadores registrados y universidades registradas
    $sql_jugadores = "SELECT COUNT(*) AS total_jugadores FROM jugadores";
    $sql_universidades = "SELECT COUNT(*) AS total_universidades FROM academias";
    $query_jugadores = $pdo->prepare($sql_jugadores);
    $query_universidades = $pdo->prepare($sql_universidades);
    $query_jugadores->execute();
    $query_universidades->execute();
    $total_jugadores = $query_jugadores->fetch(PDO::FETCH_ASSOC)['total_jugadores'];
    $total_universidades = $query_universidades->fetch(PDO::FETCH_ASSOC)['total_universidades'];

?>    
   

<div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="bebas text-dark border-bottom pb-2">Resumen de Entrenamiento</h2>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card bg-dark text-white shadow">
                        <div class="card-body">
                            <h5>Total Jugadores</h5>
                            <h2 class="text-warning"><?php echo $total_jugadores; ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card bg-dark text-white shadow">
                        <div class="card-body">
                            <h5>Total Universidades</h5>
                            <h2 class="text-warning"><?php echo $total_universidades; ?></h2>
                        </div>
                    </div>
                </div>
                </div>
        </div>






<?php include '../layouts/parte2.php'; ?>
