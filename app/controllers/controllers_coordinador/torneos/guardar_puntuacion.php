<?php
include('../../../../app/config.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_juego = $_POST['id_juego'] ?? null;
    $todas_stats = $_POST['stats'] ?? [];

    try {
        $pdo->beginTransaction();

        // La magia está en "ON DUPLICATE KEY UPDATE"
        $sql = "INSERT INTO Resultados_Individuales 
                (id_juego_fk, id_jugador_fk, puntos, asistencias, robos, rebotes) 
                VALUES (:juego, :jugador, :pts, :ast, :rob, :reb)
                ON DUPLICATE KEY UPDATE 
                puntos = :pts_up, 
                asistencias = :ast_up, 
                robos = :rob_up, 
                rebotes = :reb_up";
        
        $stmt = $pdo->prepare($sql);
        $actualizados = 0;

        foreach ($todas_stats as $id_jugador => $campos) {
            // Solo procesamos si el jugador tuvo alguna estadística (o para limpiar si se puso en 0)
            $pts = (int)$campos['pts'];
            $ast = (int)$campos['ast'];
            $rob = (int)$campos['rob'];
            $reb = (int)$campos['reb'];

            $stmt->execute([
                ':juego'    => $id_juego,
                ':jugador'  => $id_jugador,
                ':pts'      => $pts,
                ':ast'      => $ast,
                ':rob'      => $rob,
                ':reb'      => $reb,
                ':pts_up'   => $pts, // Valores para la actualización
                ':ast_up'   => $ast,
                ':rob_up'   => $rob,
                ':reb_up'   => $reb
            ]);
            $actualizados++;
        }

        $pdo->commit();
        $_SESSION['mensaje'] = "Estadísticas sincronizadas correctamente.";
        $_SESSION['color'] = "alert-success";

    } catch (Exception $e) {
        $pdo->rollBack();
        $_SESSION['mensaje'] = "Error al sincronizar: " . $e->getMessage();
        $_SESSION['color'] = "alert-danger";
    }

    header("Location: ../../../../client/coordinador/views/torneos/index.php");
    exit();
}