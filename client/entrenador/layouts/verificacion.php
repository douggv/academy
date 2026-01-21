<?php
    // 1. Verificación inteligente de sesión
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // 2. Carga única de configuración
    // Usamos require_once para que si ya se cargó en el index, no lo vuelva a intentar
    require_once __DIR__ . '/../../../app/config.php';

    // 3. Lógica de control de acceso
    if (!isset($_SESSION['sesionentrenador'])) {
        $_SESSION['mensaje'] = "Debes iniciar sesión para acceder";
        $_SESSION['icon_mensaje'] = "warning"; // Útil para SweetAlert o iconos
        
        header('Location: ' . $URL . '/login.php');
        exit(); 
    } else {
        $usuario_sesion = $_SESSION['sesionentrenador'];
        $rol_sesion = "Entrenador";
    }
?>
