<?php
include '../../layouts/verificacion.php'; 

$id_universidad_fk = $_POST['id_universidad_fk'];
$fecha_hora_asistencia = $_POST['fecha_hora_asistencia'];
$descripcion = $_POST['descripcion'];

$sentencia = $pdo->prepare("INSERT INTO asistencia 
    (fecha_hora_asistencia, descripcion, id_universidad_fk) 
    VALUES (:fecha_hora_asistencia, :descripcion, :id_universidad_fk)");

$sentencia->bindParam(':fecha_hora_asistencia', $fecha_hora_asistencia);
$sentencia->bindParam(':descripcion', $descripcion);
$sentencia->bindParam(':id_universidad_fk', $id_universidad_fk);

if($sentencia->execute()){
    session_start();
    $_SESSION['mensaje'] = "Entrenamiento registrado correctamente";
    $_SESSION['color'] = "alert alert-success";
    header('Location: index.php');
} else {
    session_start();
    $_SESSION['mensaje'] = "Error al registrar el entrenamiento";
    $_SESSION['color'] = "alert alert-danger";
    header('Location: create.php');
}
?>