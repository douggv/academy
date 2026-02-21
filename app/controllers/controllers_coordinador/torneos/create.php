<?php
include('../../../../app/config.php'); 
// 1. Gestión de sesión segura
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Conexión a la base de datos (Asegúrate de tener tu archivo de conexión)


if (isset($_POST['registrar_juego'])) {
    
    // 3. Recibir y limpiar datos
    $tipo_juego            = $_POST['tipo_juego'];
    $fecha                 = $_POST['fecha'];
    $id_academia_local     = intval($_POST['id_academia_local']);
    $id_academia_visitante = intval($_POST['id_academia_visitante']);
    $lugar                 = htmlspecialchars($_POST['lugar']);

    // 4. Validaciones de servidor
    if ($id_academia_local === $id_academia_visitante) {
        $_SESSION['mensaje'] = "Una academia no puede enfrentarse a sí misma.";
        $_SESSION['color'] = "alert-danger";
        header("Location: ../../../../client/coordinador/views/torneos/create.php");
        exit();
    }

    if (empty($fecha) || empty($tipo_juego)) {
        $_SESSION['mensaje'] = "Todos los campos obligatorios deben ser llenados.";
        $_SESSION['color'] = "alert-danger";
        header("Location: ../../../../client/coordinador/views/torneos/create.php");
        exit();
    }

    try {
        // 5. Preparar la sentencia SQL (Usando los campos de tu ALTER TABLE)
        $sql = "INSERT INTO juegos (fecha_juego, lugar, id_academia_local, id_academia_visitante, tipo_juego) 
                VALUES (:fecha, :lugar, :local, :visitante, :tipo)";
        
        $stmt = $pdo->prepare($sql);
        
        // 6. Ejecutar con los parámetros vinculados
        $resultado = $stmt->execute([
            ':fecha'     => $fecha,
            ':lugar'     => $lugar,
            ':local'     => $id_academia_local,
            ':visitante' => $id_academia_visitante,
            ':tipo'      => $tipo_juego
        ]);

        if ($resultado) {
            $_SESSION['mensaje'] = "¡Juego registrado exitosamente entre las academias!";
            $_SESSION['color'] = "alert-success";
        }

    } catch (PDOException $e) {
        // Manejo de errores de base de datos
        $_SESSION['mensaje'] = "Error en la base de datos: " . $e->getMessage();
        $_SESSION['color'] = "alert-danger";
    }

    // 7. Redireccionar de vuelta al formulario o a la lista de juegos
    header("Location: ../../../../client/coordinador/views/torneos/index.php");
    exit();
} else {
    // Si intentan entrar al archivo directamente sin enviar el formulario
    header("Location: ../../../../client/coordinador/views/torneos/create.php");
    exit();
}
?>