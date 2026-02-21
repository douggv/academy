<?php
session_start();
include('../../../../app/config.php'); 

// Verificar que los datos vengan por el método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Recibir y limpiar datos del formulario
    $id_juego = $_POST['id_juego'] ?? '';
    $puntos_local = $_POST['puntos_local'] ?? 0;
    $puntos_visitante = $_POST['puntos_visitante'] ?? 0;
    $ganador = $_POST['ganador'] ?? '';

    // Validaciones básicas
    if (empty($id_juego) || empty($ganador)) {
        $_SESSION['mensaje'] = "Error: Faltan datos obligatorios para registrar el resultado.";
        $_SESSION['color'] = "danger";
        header("Location: " . $_SERVER['HTTP_REFERER']); // Regresa a la página anterior
        exit();
    }

    try {
        // Preparar la consulta de actualización
        // Ajustado a los nombres de columna: puntos_local, puntos_visitante, ganador
        $sql = "UPDATE Juegos SET 
                    puntos_local = :puntos_local, 
                    puntos_visitante = :puntos_visitante, 
                    ganador = :ganador 
                WHERE id_juego = :id_juego";
        
        $stmt = $pdo->prepare($sql);

        // Vincular los parámetros
        $stmt->bindParam(':puntos_local', $puntos_local, PDO::PARAM_INT);
        $stmt->bindParam(':puntos_visitante', $puntos_visitante, PDO::PARAM_INT);
        $stmt->bindParam(':ganador', $ganador, PDO::PARAM_STR);
        $stmt->bindParam(':id_juego', $id_juego, PDO::PARAM_INT);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            $_SESSION['mensaje'] = "¡Resultado actualizado correctamente! Final: $puntos_local - $puntos_visitante";
            $_SESSION['color'] = "success";
        } else {
            $_SESSION['mensaje'] = "No se pudieron actualizar los datos del marcador.";
            $_SESSION['color'] = "warning";
        }

    } catch (PDOException $e) {
        // Manejo de errores de base de datos
        $_SESSION['mensaje'] = "Error en la base de datos: " . $e->getMessage();
        $_SESSION['color'] = "danger";
    }

    // Redireccionar al index de torneos o lista de juegos
    header("Location: ../../../../client/coordinador/views/torneos/index.php");
    exit();

} else {
    // Si alguien intenta entrar directamente al archivo sin POST
    header("Location: ../../../../client/coordinador/views/torneos/index.php");
    exit();
}