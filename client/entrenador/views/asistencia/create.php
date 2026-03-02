<?php 
include '../../layouts/verificacion.php'; 
// Aquí ya tenemos $pdo, $id_universidad_entrenador y las fechas por defecto
?>
<?php include '../../../../alert.php'; ?> 

<?php include '../../layouts/parte1.php'; ?> 

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card card-outline card-primary shadow">
                <div class="card-header">
                    <h3 class="card-title">Registrar Nuevo Entrenamiento</h3>
                </div>
                <div class="card-body">
                    <form action="controller_create.php" method="POST">
                        <input type="hidden" name="id_universidad_fk" value="<?php echo $id_universidad_entrenador; ?>">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Fecha y Hora del Entrenamiento</label>
                                    <input type="datetime-local" name="fecha_hora_asistencia" 
                                           class="form-control" value="<?php echo date('Y-m-d\TH:i'); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nombre de la Universidad/Sede</label>
                                    <input type="text" class="form-control" 
                                           value="ID Sede: <?php echo $id_universidad_entrenador; ?>" disabled>
                                    <small class="text-muted">El registro se vinculará automáticamente a su universidad.</small>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Descripción / Título del Entrenamiento</label>
                                    <input type="text" name="descripcion" class="form-control" 
                                           placeholder="Ej: Entrenamiento Táctico - Lunes Mañana" required>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <a href="index.php" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Guardar Entrenamiento</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../../layouts/parte2.php'; ?>