<?php include '../../layouts/verificacion.php'; ?>

<?php include '../../layouts/parte1.php'; ?> 

<?php
    // Solo inicia sesión si no hay una activa
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if(isset($_SESSION['mensaje'])):
        $mensaje = $_SESSION['mensaje'];
        // Si no existe 'color', usamos 'alert-info' por defecto
        $color = isset($_SESSION['color']) ? $_SESSION['color'] : 'alert-info';
?>
    <div id="alerta-flotante" 
         class="alert <?= $color ?> alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 shadow-lg" 
         style="z-index: 9999; min-width: 320px; text-align: center;" 
         role="alert">
        
        <i class="bi bi-info-circle me-2"></i> <strong><?= $mensaje ?></strong>
        
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <script>
        setTimeout(function() {
            const alerta = document.getElementById('alerta-flotante');
            if (alerta) {
                alerta.classList.remove('show');
                setTimeout(() => alerta.remove(), 500);
            }
        }, 3000);
    </script>

<?php 
    unset($_SESSION['mensaje']);
    unset($_SESSION['color']);
    endif; 
?>












<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow border-0">
                <div class="card-header bg-dark text-white text-center py-3">
                    <h4 class="mb-0"><i class="bi bi-person-badge"></i> Registro de Jugador</h4>
                </div>
                <div class="card-body p-4">
                    <form action="<?php echo $URL ?>/app/controllers/controllers_entrenador/jugadores/create.php" method="POST" enctype="multipart/form-data">
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Nombre Completo</label>
                                    <input type="text" name="nombre_jugador" class="form-control" 
                                           pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Email</label>
                                    <input type="email" name="email_jugador" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-center d-block">Foto Perfil</label>
                                    <div class="d-flex flex-column align-items-center border rounded p-2 bg-light">
                                        <i class="bi bi-camera text-muted" style="font-size: 2rem;"></i>
                                        <input type="file" name="imagen_jugador" id="foto" class="form-control form-control-sm mt-2" accept="image/*">
                                    </div>
                                    <small class="text-muted d-block mt-1">Formatos: JPG, PNG</small>
                                </div>
                            </div>
                        </div>
                        <input value="<?php echo $usuarioLogueado['id_universidad_fk']; ?>" type="hidden" name="id_universidad_fk">

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <<label class="form-label fw-bold">Altura (m)</label>
                                <input type="text" 
                                    name="altura_jugador" 
                                    class="form-control" 
                                    pattern="^[0-9.]+$" 
                                    placeholder="180"
                                    title="Solo se permiten números y puntos (.)" 
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '')"
                                    required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Peso (kg)</label>
                                <input type="number" name="peso_jugador" class="form-control" placeholder="80" step="0.1" required>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label fw-bold">Nacimiento</label>
                                <input type="date" name="fecha_nacimiento" class="form-control" required>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-cloud-arrow-up"></i> Guardar Jugador
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include '../../layouts/parte2.php'; ?>  