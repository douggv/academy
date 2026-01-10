<?php
    session_start();
    if(isset($_SESSION['mensaje'])):
        $mensaje = $_SESSION['mensaje'];
        $color = $_SESSION['color'];
?>
    <div id="alerta-flotante" 
         class="<?= $color ?> alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 shadow-lg" 
         style="z-index: 9999; min-width: 320px; text-align: center;" 
         role="alert">
        
        <i class="bi bi-info-circle me-2"></i> <strong><?= $mensaje ?></strong>
        
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <script>
        // Esperar 3 segundos y cerrar la alerta usando la API de Bootstrap
        setTimeout(function() {
            const alerta = document.getElementById('alerta-flotante');
            if (alerta) {
                // Esto aplica la animación de desvanecimiento de Bootstrap
                alerta.classList.remove('show');
                // Eliminar el elemento del DOM después de la animación (0.5s después)
                setTimeout(() => alerta.remove(), 500);
            }
        }, 3000);
    </script>

<?php 
    // LIMPIEZA INMEDIATA: Una vez que PHP genera el HTML, borramos la sesión
    unset($_SESSION['mensaje']);
    unset($_SESSION['color']);
    endif; 
?>