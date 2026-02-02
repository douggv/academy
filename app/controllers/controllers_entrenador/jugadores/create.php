<?php
include '../../../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_jugador = $_POST['nombre_jugador'];
    $email_jugador = $_POST['email_jugador'];
    $altura_jugador = $_POST['altura_jugador'];
    $peso_jugador = $_POST['peso_jugador'];
    $id_universidad_fk = $_POST['id_universidad_fk'];

    // 1. VERIFICAR SI EL CORREO YA EXISTE
    $sql_check = "SELECT id_jugador FROM jugadores WHERE email_jugador = :email LIMIT 1";
    $query_check = $pdo->prepare($sql_check);
    $query_check->bindParam(':email', $email_jugador);
    $query_check->execute();

    if ($query_check->rowCount() > 0) {
        // El correo ya existe, enviamos error
        session_start();
        $_SESSION['mensaje'] = 'El correo electrónico ya está registrado';
        $_SESSION['color'] = 'error';
        header('Location: ' . $URL . '/client/entrenador/views/jugadores/create.php');
        exit();
    }

    // 2. MANEJAR LA SUBIDA DE IMAGEN (Si el correo no existe, procedemos)
    if (isset($_FILES['imagen_jugador']) && $_FILES['imagen_jugador']['error'] == 0) {
        $imagen_nombre = $nombre_jugador . '_' . time() . '_' . $_FILES['imagen_jugador']['name'];
        $directorio_destino = __DIR__ . "/../../../../client/assets/img/jugadores/";

        if (move_uploaded_file($_FILES['imagen_jugador']['tmp_name'], $directorio_destino . $imagen_nombre)) {
            $imagen_para_db = $imagen_nombre; // Guardamos solo el nombre para ser consistente con tu bindParam
        } else {
            $imagen_para_db = 'default.png';
        }
    } else {
        $imagen_para_db = 'default.png';
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
        session_start();
        $_SESSION['mensaje'] = 'jugador_creado';
        $_SESSION['color'] = 'success';
        header('Location: ' . $URL . '/client/entrenador/views/jugadores/index.php');
        exit();
    } else {
        session_start();
        $_SESSION['mensaje'] = 'Error al crear el registro';
        $_SESSION['color'] = 'error';
        header('Location: ' . $URL . '/client/entrenador/views/jugadores/create.php');
        exit();
    }
} else {
    header('Location: ' . $URL . '/client/entrenador/views/jugadores/create.php');
    exit();
}
?>