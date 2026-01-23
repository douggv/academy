<?php
   
include('../../../config.php');

// 1. Capturar el ID enviado por el formulario POST
$id_jugador = $_POST['id_jugador'];

// 2. Consultar el nombre de la imagen antes de borrar el registro
// Esto es necesario para poder eliminar el archivo de la carpeta
$query_foto = $spdo->prepare("SELECT imagen_jugador FROM jugadores WHERE id_jugador = :id_jugador");
$query_foto->bindParam(':id_jugador', $id_jugador);
$query_foto->execute();
$datos_jugador = $query_foto->fetch(PDO::FETCH_ASSOC);

$nombre_fichero = $datos_jugador['imagen_jugador'];
$ruta_fichero = "../../../../public/images/jugadores/" . $nombre_fichero;

// 3. Preparar la sentencia de eliminación
$sentencia = $pdo->prepare("DELETE FROM jugadores WHERE id_jugador = :id_jugador");
$sentencia->bindParam('id_jugador', $id_jugador);

try {
    if ($sentencia->execute()) {
        // 4. Si se borró de la BD, procedemos a borrar la imagen física si existe
        if (!empty($nombre_fichero) && file_exists($ruta_fichero)) {
            unlink($ruta_fichero); // Borra el archivo del servidor
        }

        session_start();
        $_SESSION['mensaje'] = "Se eliminó al jugador y su información correctamente.";
        $_SESSION['icono'] = "success";
        header('Location: ' . $URL . '/client/entrenador/views/jugadores/index.php');
    } else {
        throw new Exception("Error al ejecutar la eliminación");
    }
} catch (Exception $e) {
    session_start();
    $_SESSION['mensaje'] = "No se pudo eliminar al jugador. Posiblemente esté relacionado a otros datos.";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/client/entrenador/views/jugadores/index.php');
}  
?>