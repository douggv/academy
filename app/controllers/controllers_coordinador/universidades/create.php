<?php
include('../../../../app/config.php'); 

$nombre_universidad = $_POST['nombre_universidad'] ?? '';
$ubicacion = $_POST['ubicacion'] ?? '';

// 1. Limpiar el nombre de la universidad para el archivo (ej: "Uni del Zulia" -> "Uni_del_Zulia")
// Reemplazamos espacios por guiones bajos y quitamos caracteres raros
$nombre_archivo_limpio = preg_replace('/[^A-Za-z0-9\-]/', '_', $nombre_universidad);

$nombre_imagen = "";
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
    $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
    
    // El nombre será literal el de la universidad + la extensión original
    $nombre_imagen = $nombre_archivo_limpio . "." . $extension;
    
    // Ruta corregida usando __DIR__ para evitar errores de carpeta
    $ruta_destino = __DIR__ . "/../../../../public/images/universidades/" . $nombre_imagen;

    // Verificar si la carpeta existe, si no, crearla
    $directorio = dirname($ruta_destino);
    if (!file_exists($directorio)) {
        mkdir($directorio, 0777, true);
    }

    // Guardar la imagen
    if(copy($_FILES['imagen']['tmp_name'], $ruta_destino)) {
        // Éxito al copiar
    } else {
        die("Error: No se pudo mover el archivo a la carpeta de destino. Verifique permisos.");
    }
}

try {
    // IMPORTANTE: Asegúrate de que las columnas coincidan con tu DB (quitamos fyh_creacion)
    $sql = "INSERT INTO academias (nombre_universidad, ubicacion, imagen) 
            VALUES (:nombre_universidad, :ubicacion, :imagen)";
            
    $sentencia = $pdo->prepare($sql);

    $sentencia->bindParam(':nombre_universidad', $nombre_universidad);
    $sentencia->bindParam(':ubicacion', $ubicacion);
    $sentencia->bindParam(':imagen', $nombre_imagen);

    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Universidad registrada con éxito";
        $_SESSION['icono'] = "success";
        header('Location: ' . $URL . '/client/coordinador/views/universidades/index.php');
    }
} catch (PDOException $e) {
    echo "Error en la base de datos: " . $e->getMessage();
}
?>