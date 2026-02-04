<?php include '../../layouts/verificacion.php'; ?>

<?php include '../../layouts/parte1.php'; ?>    

<?php 
   // Tu código SQL original
   $sql = "SELECT * FROM academias 
    ORDER BY id_universidad ASC";
    $query = $pdo->prepare($sql);
    $query->execute();
    $universidades = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
    .admin-card-table {
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        margin-top: 20px;
    }

    .table-header-custom {
        background: var(--admin-sidebar); /* El azul oscuro que definimos antes */
        color: white;
        padding: 20px 25px;
    }

    .uni-table {
        width: 100%;
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .uni-table th {
        background: #f8fafc;
        color: #64748b;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 15px 25px;
        border-bottom: 2px solid #edf2f7;
    }

    .uni-table td {
        padding: 18px 25px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
        font-size: 0.95rem;
    }

    .uni-table tr:hover {
        background-color: #fbfcfd;
    }

    /* Estilo para la imagen/logo de la uni */
    .uni-logo-circle {
        width: 45px;
        height: 45px;
        border-radius: 8px;
        object-fit: cover;
        border: 1px solid #e2e8f0;
        background: #f8fafc;
    }

    .location-badge {
        background: #f1f5f9;
        color: #475569;
        padding: 4px 12px;
        border-radius: 6px;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
    }

    .btn-action {
        padding: 6px 12px;
        font-size: 0.8rem;
        border-radius: 6px;
        transition: 0.2s;
    }
</style>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="bebas mb-0">Gestión de Universidades</h2>
            <p class="text-muted small">Listado oficial de instituciones registradas en la liga</p>
        </div>
        <a href="create.php" class="btn btn-primary" style="background-color: var(--admin-accent); border: none;">
            <i class="fas fa-plus me-2"></i> Nueva Universidad
        </a>
    </div>

    <div class="admin-card-table">
        <div class="table-responsive">
            <table class="table uni-table">
                <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Nombre de la Institución</th>
                        <th>Ubicación</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($universidades as $uni): ?>
                    <tr>
                        <td width="80">
                            <?php if (!empty($uni['imagen'])): ?>
                                <img src="<?php echo $URL; ?><?php echo $uni['imagen']; ?>" 
                                     alt="Logo" class="uni-logo-circle">
                            <?php else: ?>
                                <div class="uni-logo-circle d-flex align-items-center justify-content-center bg-light">
                                    <i class="fas fa-school text-muted"></i>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="fw-bold"><?php echo $uni['nombre_universidad']; ?></span>
                        </td>
                        <td>
                            <div class="location-badge">
                                <i class="fas fa-map-marker-alt me-2 text-danger"></i>
                                <?php echo $uni['ubicacion']; ?>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="show.php?id=<?php echo $uni['id_universidad']; ?>" 
                                   class="btn btn-action btn-outline-dark me-2">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="update.php?id=<?php echo $uni['id_universidad']; ?>" 
                                   class="btn btn-action btn-outline-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<?php include '../../layouts/parte2.php'; ?>