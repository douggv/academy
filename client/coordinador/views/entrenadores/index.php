<?php include '../../layouts/verificacion.php'; ?>
<?php include '../../layouts/parte1.php'; ?>    

<?php 
// Consulta para obtener entrenadores y su universidad asignada
$sql = "SELECT usu.id_usuario, usu.nombre_usuario, usu.email_usuario, uni.nombre_universidad, uni.imagen as logo_uni 
        FROM usuarios as usu
        INNER JOIN academias as uni ON usu.id_universidad_fk = uni.id_universidad
        WHERE usu.id_rol_fk = 3 
        ORDER BY usu.nombre_usuario ASC";

$query = $pdo->prepare($sql);
$query->execute();
$entrenadores = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
    .coach-card-container {
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.03);
        overflow: hidden;
    }

    .table-coach {
        width: 100%;
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table-coach th {
        background: #f8fafc;
        color: #475569;
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 18px 25px;
        border-bottom: 2px solid #f1f5f9;
    }

    .table-coach td {
        padding: 15px 25px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
        color: #1e293b;
    }

    .uni-logo-sm {
        width: 38px;
        height: 38px;
        border-radius: 6px;
        object-fit: cover;
        border: 1px solid #e2e8f0;
        background: #fff;
    }

    .coach-name-wrapper {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .coach-icon {
        width: 35px;
        height: 35px;
        background: #e2e8f0;
        color: #475569;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 0.9rem;
    }

    .email-link {
        color: #64748b;
        text-decoration: none;
        font-size: 0.85rem;
    }

    .email-link:hover {
        color: var(--admin-accent);
    }

    .uni-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-weight: 600;
        color: #334155;
    }

    /* Estilo adicional para el botón PDF */
    .btn-pdf {
        background-color: #dc3545;
        color: white !important;
    }
    .btn-pdf:hover {
        background-color: #bb2d3b;
    }
</style>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="bebas mb-0" style="color: var(--admin-dark);">Panel de Entrenadores</h2>
            <p class="text-muted small mb-0">Listado de personal técnico por institución</p>
        </div>
        <div class="d-flex gap-2">
            <button onclick="generarReporte()" class="btn btn-danger px-4 shadow-sm">
                <i class="fas fa-file-pdf me-2"></i> Generar Reporte
            </button>
            <a href="create.php" class="btn btn-dark px-4 shadow-sm">
                <i class="fas fa-plus me-2"></i> Nuevo Entrenador
            </a>
        </div>
    </div>

    <div class="coach-card-container">
        <div class="table-responsive">
            <table class="table table-coach">
                <thead>
                    <tr>
                        <th>Entrenador</th>
                        <th>Correo Electrónico</th>
                        <th>Institución Asignada</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($entrenadores)): ?>
                        <?php foreach ($entrenadores as $coach): ?>
                        <tr>
                            <td>
                                <div class="coach-name-wrapper">
                                    <div class="coach-icon">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                    <span class="fw-bold"><?php echo htmlspecialchars($coach['nombre_usuario']); ?></span>
                                </div>
                            </td>
                            <td>
                                <a href="mailto:<?php echo $coach['email_usuario']; ?>" class="email-link">
                                    <i class="far fa-envelope me-2"></i><?php echo htmlspecialchars($coach['email_usuario']); ?>
                                </a>
                            </td>
                            <td>
                                <div class="uni-badge">
                                    <?php if(!empty($coach['logo_uni'])): ?>
                                        <img src="../../../../public/images/universidades/<?php echo $coach['logo_uni']; ?>" 
                                             class="uni-logo-sm" alt="Logo">
                                    <?php else: ?>
                                        <div class="uni-logo-sm d-flex align-items-center justify-content-center">
                                            <i class="fas fa-university text-muted" style="font-size: 0.7rem;"></i>
                                        </div>
                                    <?php endif; ?>
                                    <span><?php echo htmlspecialchars($coach['nombre_universidad']); ?></span>
                                </div>
                            </td>
                            <td class="text-center">
                                <a href="update.php?id=<?php echo $coach['id_usuario']; ?>" class="btn btn-outline-warning btn-sm border-0">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="update.php?id=<?php echo $coach['id_usuario']; ?>" class="btn btn-outline-danger btn-sm border-0">
                                    <i class="fas fa-trash"></i>
                            </td>

                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <span class="text-muted italic">No hay entrenadores registrados en el sistema.</span>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Confirmación de eliminación
    document.querySelectorAll('.btn-outline-danger').forEach(button => {
        button.onclick = (e) => {
            if(!confirm('¿Está seguro de que desea retirar a este entrenador del sistema?')) {
                e.preventDefault();
            }
        }
    });
</script>


<style>
/* Estilos especiales para cuando se imprima */
@media print {
    /* Ocultar elementos innecesarios (ajusta las clases según tu layout) */
    .btn, .main-sidebar, .main-footer, .nav, .navbar, .acciones-col {
        display: none !important;
    }

    /* Ajustar el contenedor para que use toda la hoja */
    .content-wrapper, .container-fluid {
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
    }

    .coach-card-container {
        border: none !important;
        box-shadow: none !important;
    }

    /* Forzar que la tabla se vea bien */
    .table-coach {
        width: 100% !important;
        border: 1px solid #000 !important;
    }
    
    .table-coach th {
        background-color: #f1f5f9 !important;
        color: #000 !important;
        -webkit-print-color-adjust: exact;
    }

    /* Añadir un título que solo aparezca en la impresión */
    .print-header {
        display: block !important;
        text-align: center;
        margin-bottom: 20px;
    }
}

/* Ocultar el título de impresión en la pantalla normal */
.print-header {
    display: none;
}
</style>

<script>
function generarReporte() {
    // 1. Opcional: Cambiar el título del documento para el nombre del archivo
    const originalTitle = document.title;
    document.title = "Reporte_Entrenadores_<?php echo date('d-m-Y'); ?>";

    // 2. Ejecutar la ventana de impresión/PDF del navegador
    window.print();

    // 3. Restaurar el título
    document.title = originalTitle;
}
</script>

<?php include '../../layouts/parte2.php'; ?>