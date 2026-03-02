<?php
include('../../../../app/config.php'); // Asegúrate de que la ruta a tu conexión PDO sea correcta

// 1. Recibir los datos del formulario
$id_usuario = $_POST['id_usuario'];
$nombre_usuario = $_POST['nombre_usuario'];
$email_usuario = $_POST['email_usuario'];
$id_universidad_fk = $_POST['id_universidad_fk'];
$password = $_POST['password'];

// Iniciar una sesión para manejar mensajes de alerta (opcional pero recomendado)
session_start();

try {
    // 2. Verificar si se desea cambiar la contraseña
    if (empty($password)) {
        // No se escribió nada en el campo password: No actualizamos la clave
        $sentencia = $pdo->prepare("UPDATE usuarios 
            SET nombre_usuario = :nombre_usuario, 
                email_usuario = :email_usuario, 
                id_universidad_fk = :id_universidad_fk
            WHERE id_usuario = :id_usuario");
    } else {
        // Se escribió una nueva clave: Debemos encriptarla
        $password_encriptada = password_hash($password, PASSWORD_DEFAULT);
        
        $sentencia = $pdo->prepare("UPDATE usuarios 
            SET nombre_usuario = :nombre_usuario, 
                email_usuario = :email_usuario, 
                id_universidad_fk = :id_universidad_fk,
                password_usuario = :password_usuario
            WHERE id_usuario = :id_usuario");
            
        $sentencia->bindParam(':password_usuario', $password_encriptada);
    }

    // 3. Vincular los parámetros comunes
    $sentencia->bindParam(':nombre_usuario', $nombre_usuario);
    $sentencia->bindParam(':email_usuario', $email_usuario);
    $sentencia->bindParam(':id_universidad_fk', $id_universidad_fk);
    $sentencia->bindParam(':id_usuario', $id_usuario);

    // 4. Ejecutar y redireccionar
    if ($sentencia->execute()) {
        $_SESSION['mensaje'] = "Se actualizó al entrenador correctamente";
        $_SESSION['color'] = "alert alert-success";
        header('Location: ' . $URL . '/client/coordinador/views/entrenadores/index.php'); // Ajusta la URL de retorno
    } else {
        throw new Exception("Error al ejecutar la consulta");
    }

} catch (Exception $e) {
    $_SESSION['mensaje'] = "Error al actualizar en la base de datos";

    $_SESSION['color'] = "alert alert-danger";
    header('Location: ' . $_SERVER['HTTP_REFERER']); // Regresa al formulario
}