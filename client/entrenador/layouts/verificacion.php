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
        $rol = $_SESSION['rol'];
        $rol_sesion = "Entrenador";

        // 1. Usamos un marcador de posición (:email) en lugar de la variable directa
        $sql2 = "SELECT * FROM usuarios WHERE email_usuario = :email";
        
        // 2. Preparamos la consulta
        $query = $pdo->prepare($sql2);

        // 3. Vinculamos el valor de la sesión al marcador
        $query->bindParam(':email', $usuario_sesion);

        // 4. Ejecutamos
        $query->execute();

        // 5. Como es un solo usuario, usamos fetch() en lugar de fetchAll() 
        // para acceder directo a los datos sin un bucle foreach adicional.
        $usuarioLogueado = $query->fetch(PDO::FETCH_ASSOC);
        // guardo el id de la universidad del entrenador logueago 
        $id_universidad_entrenador = $usuarioLogueado['id_universidad_fk'];        
    }
    
?>
