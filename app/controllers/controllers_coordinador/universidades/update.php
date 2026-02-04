<?php
include('../../../../app/config.php');

$id_universidad = $_POST['id_universidad'];
$nombre_universidad = $_POST['nombre_universidad'];
$ubicacion = $_POST['ubicacion'];

// 1. Limpiar nombre para el archivo
$nombre_archivo_limpio = preg_replace('/[^A-Za-z0-9\-]/', '_', $nombre_universidad);

// 2. Lógica de Imagen
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
    // Si subió una imagen nueva, procesamos el nombre
    $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
    $nombre_imagen = $nombre_archivo_limpio . "." . $extension;
    $ruta_destino = __DIR__ . "/../../../../public/images/universidades/" . $nombre_imagen;

    // Guardar el archivo
    copy($_FILES['imagen']['tmp_name'], $ruta_destino);
} else {
    // Si no subió imagen nueva, buscamos el nombre de la imagen actual en la DB para no perderla
    $query_img = $pdo->prepare("SELECT imagen FROM academias WHERE id_universidad = :id");
    $query_img->execute(['id' => $id_universidad]);
    $resultado = $query_img->fetch(PDO::FETCH_ASSOC);
    $nombre_imagen = $resultado['imagen'];
}

try {
    // 3. Ejecutar Update
    $sentencia = $pdo->prepare("UPDATE academias 
        SET nombre_universidad = :nombre_universidad, 
            ubicacion = :ubicacion, 
            imagen = :imagen 
        WHERE id_universidad = :id_universidad");

    $sentencia->bindParam(':nombre_universidad', $nombre_universidad);
    $sentencia->bindParam(':ubicacion', $ubicacion);
    $sentencia->bindParam(':imagen', $nombre_imagen);
    $sentencia->bindParam(':id_universidad', $id_universidad);

    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Universidad actualizada correctamente";
        $_SESSION['icono'] = "success";
        header('Location: ' . $URL . '/client/coordinador/views/universidades/index.php');
    }
} catch (PDOException $e) {
    echo "Error al actualizar: " . $e->getMessage();
}
?>
