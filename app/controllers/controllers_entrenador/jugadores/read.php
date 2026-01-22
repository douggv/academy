<?php
// Preparamos la consulta filtrando por la universidad del usuario
$sql = "SELECT * FROM jugadores WHERE id_universidad_fk = :id_uni";

$query = $pdo->prepare($sql);
// Enlazamos el parámetro del usuario logueado
$query->bindParam(':id_uni', $usuarioLogueado['id_universidad_fk']);
$query->execute();
$jugadores = $query->fetchAll(PDO::FETCH_ASSOC);
?>