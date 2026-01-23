<?php
include('../../../config.php');

$id_jugador = $_POST['id_jugador'];
$nombre_jugador = $_POST['nombre_jugador'];
$email_jugador = $_POST['email_jugador'];
$altura_jugador = $_POST['altura_jugador'];
$peso_jugador = $_POST['peso_jugador'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];

// 1. Manejo de la Imagen
if ($_FILES['imagen_jugador']['name'] != null) {
    // Si subió una foto nueva, borramos la anterior
    $query_foto = $pdo->prepare("SELECT imagen_jugador FROM jugadores WHERE id_jugador = :id");
    $query_foto->execute(['id' => $id_jugador]);
    $foto_vieja = $query_foto->fetch(PDO::FETCH_ASSOC)['imagen_jugador'];
    
    if(!empty($foto_vieja)) {
        unlink("../../../../public/images/jugadores/" . $foto_vieja);
    }

    // Subir la nueva foto
    $nombre_archivo = date("Y-m-d-h-i-s") . "-" . $_FILES['imagen_jugador']['name'];
    $location = "../../../../public/images/jugadores/" . $nombre_archivo;
    move_uploaded_file($_FILES['imagen_jugador']['tmp_name'], $location);
    
    $imagen_sql = $nombre_archivo;
} else {
    // Si no subió nada, buscamos el nombre actual para no perderlo
    $query_foto = $pdo->prepare("SELECT imagen_jugador FROM jugadores WHERE id_jugador = :id");
    $query_foto->execute(['id' => $id_jugador]);
    $imagen_sql = $query_foto->fetch(PDO::FETCH_ASSOC)['imagen_jugador'];
}

// 2. Ejecutar Update
$sentencia = $pdo->prepare("UPDATE jugadores 
    SET nombre_jugador = :nombre, 
        email_jugador = :email, 
        imagen_jugador = :imagen, 
        altura_jugador = :altura, 
        peso_jugador = :peso, 
        fecha_nacimiento = :fecha 
    WHERE id_jugador = :id_jugador");

$sentencia->bindParam(':nombre', $nombre_jugador);
$sentencia->bindParam(':email', $email_jugador);
$sentencia->bindParam(':imagen', $imagen_sql);
$sentencia->bindParam(':altura', $altura_jugador);
$sentencia->bindParam(':peso', $peso_jugador);
$sentencia->bindParam(':fecha', $fecha_nacimiento);
$sentencia->bindParam(':id_jugador', $id_jugador);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizó al jugador correctamente";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/client/entrenador/views/jugadores/index.php');
} else {
    session_start();
    $_SESSION['mensaje'] = "Error al actualizar";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/client/entrenador/views/jugadores/index.php');
}