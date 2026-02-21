<?php 
include '../../layouts/verificacion.php';
include '../../layouts/parte1.php'; 

// 1. Validar que llegue el ID por GET
$id_usuario_get = $_GET['id'] ?? null;

if (!$id_usuario_get) {
    header('Location: index.php');
    exit;
}

// 2. Obtener los datos del entrenador actual
$sql_coach = "SELECT * FROM usuarios WHERE id_usuario = :id AND id_rol_fk = 3";
$query_coach = $pdo->prepare($sql_coach);
$query_coach->execute(['id' => $id_usuario_get]);
$coach = $query_coach->fetch(PDO::FETCH_ASSOC);

if (!$coach) {
    header('Location: index.php');
    exit;
}

// 3. Obtener las universidades para el Select
$sql_universidades = "SELECT id_universidad, nombre_universidad FROM academias ORDER BY nombre_universidad ASC";
$query_uni = $pdo->prepare($sql_universidades);
$query_uni->execute();
$universidades = $query_uni->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
    /* Mantenemos tus estilos originales */
    .admin-form-card { max-width: 850px; margin: 2rem auto; background: #fff; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 10px 25px rgba(0,0,0,0.05); overflow: hidden; }
    .form-header-coach { background: var(--admin-sidebar); padding: 25px 30px; color: white; border-bottom: 4px solid #ffc107; /* Amarillo para diferenciar que es edición */ }
    .form-section-title { font-size: 0.75rem; font-weight: 800; color: var(--admin-accent); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
    .form-section-title::after { content: ""; flex-grow: 1; height: 1px; background: #e2e8f0; }
    .coach-input { border: 1px solid #cbd5e1; padding: 12px 15px; border-radius: 8px; width: 100%; transition: 0.2s; }
    .coach-input:focus { border-color: var(--admin-accent); box-shadow: 0 0 0 4px rgba(249, 115, 22, 0.1); outline: none; }
    .select-coach { appearance: none; background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e"); background-repeat: no-repeat; background-position: right 1rem center; background-size: 16px 12px; }
    .btn-update-coach { background: #ffc107; color: #000; padding: 12px 35px; border-radius: 8px; border: none; font-weight: 700; transition: 0.3s; }
    .btn-update-coach:hover { background: #e0a800; transform: translateY(-2px); }
</style>

<div class="container-fluid">
    <div class="admin-form-card">
        <div class="form-header-coach">
            <h3 class="bebas mb-0"><i class="fas fa-user-edit me-2"></i> Actualizar Datos del Entrenador</h3>
        </div>

        <form action="../../../../app/controllers/controllers_coordinador/entrenadores/update.php" method="POST" class="p-4">
            
            <input type="hidden" name="id_usuario" value="<?php echo $coach['id_usuario']; ?>">

            <div class="form-section-title">Datos Personales y de Acceso</div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="small fw-bold mb-1">Nombre Completo</label>
                    <input type="text" name="nombre_usuario" class="coach-input" 
                           value="<?php echo htmlspecialchars($coach['nombre_usuario']); ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="small fw-bold mb-1">Correo Electrónico</label>
                    <input type="email" name="email_usuario" class="coach-input" 
                           value="<?php echo htmlspecialchars($coach['email_usuario']); ?>" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label class="small fw-bold mb-1">Nueva Contraseña (Dejar en blanco para no cambiar)</label>
                    <div class="position-relative">
                        <input type="password" name="password" class="coach-input" placeholder="********">
                        <small class="text-info"><i class="fas fa-info-circle"></i> Solo escriba si desea cambiar la clave actual.</small>
                    </div>
                </div>
            </div>

            <div class="form-section-title mt-4">Asignación Institucional</div>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="small fw-bold mb-1">Universidad / Academia Asignada</label>
                    <select name="id_universidad_fk" class="coach-input select-coach" required>
                        <?php foreach($universidades as $uni): ?>
                            <option value="<?php echo $uni['id_universidad']; ?>" 
                                <?php echo ($uni['id_universidad'] == $coach['id_universidad_fk']) ? 'selected' : ''; ?>>
                                <?php echo $uni['nombre_universidad']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <hr class="my-4" style="opacity: 0.1;">

            <div class="d-flex justify-content-end gap-2">
                <a href="index.php" class="btn btn-light border px-4">Cancelar</a>
                <button type="submit" class="btn btn-update-coach">
                    <i class="fas fa-sync-alt me-2"></i> Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>

<?php include '../../layouts/parte2.php'; ?>