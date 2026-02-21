<?php
include '../../../config.php';
session_start(); // Iniciamos sesión al principio para evitar errores de headers

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_jugador = trim($_POST['nombre_jugador']);
    $email_jugador = trim($_POST['email_jugador']);
    $altura_jugador = $_POST['altura_jugador'];
    $peso_jugador = $_POST['peso_jugador'];
    $id_universidad_fk = $_POST['id_universidad_fk'];

    // 1. VERIFICAR SI EL CORREO O EL NOMBRE (EN ESA UNI) YA EXISTEN
    $sql_check = "SELECT id_jugador FROM jugadores 
                  WHERE email_jugador = :email 
                  OR (nombre_jugador = :nombre AND id_universidad_fk = :id_uni) 
                  LIMIT 1";
    
    $query_check = $pdo->prepare($sql_check);
    $query_check->bindParam(':email', $email_jugador);
    $query_check->bindParam(':nombre', $nombre_jugador);
    $query_check->bindParam(':id_uni', $id_universidad_fk);
    $query_check->execute();

    if ($query_check->rowCount() > 0) {
        $_SESSION['mensaje'] = 'El jugador o el correo ya se encuentran registrados en esta academia';
        $_SESSION['color'] = 'alert alert-warning';
        header('Location: ' . $URL . '/client/entrenador/views/jugadores/create.php');
        exit();
    }

    // 2. MANEJAR LA SUBIDA DE IMAGEN
    $imagen_para_db = 'default.png'; // Valor por defecto

    if (isset($_FILES['imagen_jugador']) && $_FILES['imagen_jugador']['error'] == 0) {
        // Limpiamos el nombre para el archivo
        $nombre_limpio = str_replace(' ', '_', $nombre_jugador);
        $imagen_nombre = $nombre_limpio . '_' . time() . '.jpg'; 
        $directorio_destino = __DIR__ . "/../../../../client/assets/img/jugadores/";

        // Crear directorio si no existe
        if (!is_dir($directorio_destino)) {
            mkdir($directorio_destino, 0777, true);
        }

        if (move_uploaded_file($_FILES['imagen_jugador']['tmp_name'], $directorio_destino . $imagen_nombre)) {
            $imagen_para_db = $imagen_nombre;
        }
    }

    // 3. PREPARAR E INSERTAR
    $sql = "INSERT INTO jugadores (nombre_jugador, email_jugador, altura_jugador, peso_jugador, imagen_jugador, id_universidad_fk) 
            VALUES (:nombre_jugador, :email_jugador, :altura_jugador, :peso_jugador, :imagen_jugador, :id_universidad_fk)";

    $query = $pdo->prepare($sql);
    $query->bindParam(':nombre_jugador', $nombre_jugador);
    $query->bindParam(':email_jugador', $email_jugador);
    $query->bindParam(':altura_jugador', $altura_jugador);
    $query->bindParam(':peso_jugador', $peso_jugador);
    $query->bindParam(':imagen_jugador', $imagen_para_db);
    $query->bindParam(':id_universidad_fk', $id_universidad_fk);

    if ($query->execute()) {
        $_SESSION['mensaje'] = 'jugador_creado';
        $_SESSION['color'] = 'alert alert-success';
        header('Location: ' . $URL . '/client/entrenador/views/jugadores/index.php');
        exit();
    } else {
        $_SESSION['mensaje'] = 'Error al crear el registro';
        $_SESSION['color'] = 'alert alert-danger';
        header('Location: ' . $URL . '/client/entrenador/views/jugadores/create.php');
        exit();
    }
} else {
    header('Location: ' . $URL . '/client/entrenador/views/jugadores/create.php');
    exit();
}