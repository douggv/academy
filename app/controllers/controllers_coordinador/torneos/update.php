<?php
session_start();
include('../../../../app/config.php'); 
if (isset($_POST['actualizar'])) {
    $id_juego              = $_POST['id_juego'];
    $fecha_juego           = $_POST['fecha_juego'];
    $lugar                 = $_POST['lugar'];
    $id_academia_local     = $_POST['id_academia_local'];
    $id_academia_visitante = $_POST['id_academia_visitante'];

    // Validación: No pueden ser la misma academia
    if ($id_academia_local === $id_academia_visitante) {
        $_SESSION['error'] = "Error: El equipo local y visitante no pueden ser iguales.";
        header("Location: ../client/coordinador/views/torneos/editar_juego.php?id=$id_juego");
        exit();
    }

    try {
        $sql = "UPDATE Juegos SET 
                    fecha_juego = :fecha, 
                    lugar = :lugar, 
                    id_academia_local = :local, 
                    id_academia_visitante = :visitante 
                WHERE id_juego = :id";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':fecha'     => $fecha_juego,
            ':lugar'     => $lugar,
            ':local'     => $id_academia_local,
            ':visitante' => $id_academia_visitante,
            ':id'        => $id_juego
        ]);

        $_SESSION['mensaje'] = "Juego actualizado correctamente.";
        $_SESSION['color'] = "success";
        header("Location: ../../../../client/coordinador/views/torneos/index.php");

    } catch (PDOException $e) {
        $_SESSION['mensaje'] = "Error al actualizar: " . $e->getMessage();
        $_SESSION['color'] = "danger";
        header("Location: ../../../../client/coordinador/views/torneos/index.php");
    }
}
?>