<?php include '../../layouts/verificacion.php'; ?>

<?php include '../../layouts/parte1.php'; ?>    

<?php
// Obtener los datos actuales de la universidad
$id_universidad = $_GET['id'];
$sql = "SELECT * FROM academias WHERE id_universidad = :id_universidad";
$query = $pdo->prepare($sql);
$query->bindParam(':id_universidad', $id_universidad);
$query->execute();
$uni = $query->fetch(PDO::FETCH_ASSOC);
?>

<style>
    .update-container { max-width: 800px; margin: 2rem auto; background: #fff; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); }
    .form-header-update { background: #1e293b; padding: 20px 30px; color: white; border-bottom: 4px solid var(--admin-accent); }
    .current-logo-box { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px; text-align: center; margin-bottom: 20px; }
    .current-logo-box img { max-height: 100px; border-radius: 5px; }
    .btn-update { background: var(--admin-sidebar); color: white; padding: 12px 30px; border-radius: 8px; border: none; transition: 0.3s; font-weight: 600; }
    .btn-update:hover { background: var(--admin-accent); color: white; }
</style>

<div class="container-fluid">
    <div class="update-container">
        <div class="form-header-update">
            <h3 class="bebas mb-0"><i class="fas fa-edit me-2"></i> Actualizar Institución</h3>
        </div>

        <form action="../../../../app/controllers/controllers_coordinador/universidades/update.php" method="POST" enctype="multipart/form-data" class="p-4">
            <input type="hidden" name="id_universidad" value="<?php echo $uni['id_universidad']; ?>">

            <div class="row">
                <div class="col-md-7">
                    <div class="mb-4">
                        <label class="custom-label">Nombre de la Universidad</label>
                        <input type="text" name="nombre_universidad" class="form-control form-control-custom" 
                               value="<?php echo $uni['nombre_universidad']; ?>" required>
                    </div>

                    <div class="mb-4">
                        <label class="custom-label">Ubicación</label>
                        <input type="text" name="ubicacion" class="form-control form-control-custom" 
                               value="<?php echo $uni['ubicacion']; ?>" required>
                    </div>
                </div>

                <div class="col-md-5">
                    <label class="custom-label">Imagen Actual</label>
                    <div class="current-logo-box">
                        <?php if(!empty($uni['imagen'])): ?>
                            <img src="../../../../public/images/universidades/<?php echo $uni['imagen']; ?>" alt="Logo">
                            <p class="small text-muted mt-2 mb-0"><?php echo $uni['imagen']; ?></p>
                        <?php else: ?>
                            <i class="fas fa-school fa-3x text-light"></i>
                            <p class="small text-muted mt-2 mb-0">Sin imagen</p>
                        <?php endif; ?>
                    </div>
                    
                    <label class="custom-label">Cambiar Logo (Opcional)</label>
                    <input type="file" name="imagen" class="form-control form-control-sm">
                </div>
            </div>

            <hr class="my-4" style="opacity: 0.1;">

            <div class="d-flex justify-content-end gap-2">
                <a href="index.php" class="btn btn-light border">Cancelar</a>
                <button type="submit" class="btn btn-update">
                    <i class="fas fa-sync-alt me-2"></i> Actualizar Cambios
                </button>
            </div>
        </form>
    </div>
</div>    


<?php include '../../layouts/parte2.php'; ?>