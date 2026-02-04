<?php
include('../../../../app/config.php');

// Recibir datos del formulario
$nombre_usuario = $_POST['nombre_usuario'] ?? '';
$email_usuario = $_POST['email_usuario'] ?? '';
$password = $_POST['password'] ?? '';
$id_universidad_fk = $_POST['id_universidad_fk'] ?? '';

// Variables Automáticas
$id_rol_fk = 3; // Rol de Entrenador automático

// Encriptación de contraseña (Seguridad)
$password_encriptada = password_hash($password, PASSWORD_DEFAULT);

try {
    // Sentencia SQL para insertar el nuevo usuario/entrenador
    $sql = "INSERT INTO usuarios 
            (nombre_usuario, email_usuario, password_usuario, id_rol_fk, id_universidad_fk) 
            VALUES (:nombre_usuario, :email_usuario, :password, :id_rol_fk, :id_universidad_fk)";
            
    $sentencia = $pdo->prepare($sql);

    $sentencia->bindParam(':nombre_usuario', $nombre_usuario);
    $sentencia->bindParam(':email_usuario', $email_usuario);
    $sentencia->bindParam(':password', $password_encriptada);
    $sentencia->bindParam(':id_rol_fk', $id_rol_fk);
    $sentencia->bindParam(':id_universidad_fk', $id_universidad_fk);
  

    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Entrenador registrado y asignado correctamente";
        $_SESSION['icono'] = "success";
        header('Location: ' . $URL . '/client/coordinador/views/entrenadores/index.php');
    }
} catch (PDOException $e) {
    session_start();
    $_SESSION['mensaje'] = "Error: " . $e->getMessage();
    $_SESSION['icono'] = "error";
    //header('Location: ' . $_SERVER['HTTP_REFERER']);
    echo "Error al registrar el entrenador: " . $e->getMessage();
}
?>