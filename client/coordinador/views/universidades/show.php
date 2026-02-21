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
    /* Estilos base mantenidos y ajustados para vista Show */
    :root {
        --admin-sidebar: #1e293b;
        --admin-accent: #3b82f6; /* Color azul de ejemplo */
    }
    .show-container { max-width: 800px; margin: 2rem auto; background: #fff; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); }
    .form-header-show { background: #1e293b; padding: 20px 30px; color: white; border-bottom: 4px solid var(--admin-accent); }
    .data-box { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 15px; margin-bottom: 20px; min-height: 45px; display: flex; align-items: center; }
    .current-logo-box { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px; text-align: center; margin-bottom: 20px; }
    .current-logo-box img { max-height: 150px; border-radius: 5px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
    .custom-label { font-weight: 600; color: #64748b; margin-bottom: 8px; display: block; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.5px; }
    .info-text { color: #1e293b; font-size: 1.1rem; margin-bottom: 0; font-weight: 500; }
    .bebas { font-family: 'Bebas Neue', sans-serif; letter-spacing: 1px; }
</style>

<div class="container-fluid">
    <div class="show-container">
        <div class="form-header-show">
            <h3 class="bebas mb-0"><i class="fas fa-university me-2"></i> Detalles de la Institución</h3>
        </div>

        <div class="p-4">
            <div class="row">
                <div class="col-md-7">
                    <div class="mb-4">
                        <label class="custom-label">Nombre de la Universidad</label>
                        <div class="data-box">
                            <p class="info-text"><?php echo htmlspecialchars($uni['nombre_universidad']); ?></p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="custom-label">Ubicación / Sede</label>
                        <div class="data-box">
                            <p class="info-text"><i class="fas fa-map-marker-alt text-danger me-2"></i> <?php echo htmlspecialchars($uni['ubicacion']); ?></p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="custom-label">ID de Registro</label>
                        <div class="data-box">
                            <p class="info-text text-muted">#<?php echo $uni['id_universidad']; ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <label class="custom-label text-center d-block">Identidad Visual</label>
                    <div class="current-logo-box">
                        <?php if(!empty($uni['imagen'])): ?>
                            <img src="../../../../public/images/universidades/<?php echo $uni['imagen']; ?>" alt="Logo de la Institución">
                            <p class="small text-muted mt-3 mb-0">Archivo: <?php echo $uni['imagen']; ?></p>
                        <?php else: ?>
                            <div class="py-4">
                                <i class="fas fa-school fa-4x text-light"></i>
                                <p class="small text-muted mt-2 mb-0">Sin logo registrado</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <hr class="my-4" style="opacity: 0.1;">

            <div class="d-flex justify-content-between align-items-center">
                <span class="text-muted small italic">Vista de solo lectura</span>
                <a href="index.php" class="btn btn-outline-secondary px-4">
                    <i class="fas fa-arrow-left me-2"></i> Volver al listado
                </a>
            </div>
        </div>
    </div>
</div>


<?php include '../../layouts/parte2.php'; ?>