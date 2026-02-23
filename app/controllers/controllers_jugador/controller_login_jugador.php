<?php
include('../../config.php');

$email_input = $_POST['email_jugador'];

// Buscamos al jugador por su email
$query = $pdo->prepare("SELECT * FROM jugadores WHERE email_jugador = :email");
$query->bindParam(':email', $email_input);
$query->execute();

$jugador = $query->fetch(PDO::FETCH_ASSOC);

if ($jugador) {
    // Si existe, iniciamos sesión
    session_start();
    $_SESSION['sesion_email_jugador'] = $email_input;
    $_SESSION['id_jugador_sesion'] = $jugador['id_jugador'];
    $_SESSION['nombre_jugador_sesion'] = $jugador['nombre_jugador'];
    
    // Mensaje de éxito
    $_SESSION['mensaje'] = "Bienvenido, " . $jugador['nombre_jugador'];
    $_SESSION['color'] = "alert-success";
    
    // Redirigir al panel principal del jugador
    header('Location: '.$URL.'/client/jugador/views/index.php');
} else {
    // Si no existe, error
    session_start();
    $_SESSION['mensaje'] = "El correo ingresado no está registrado como jugador.";
    $_SESSION['color'] = "alert-danger";
    header('Location: '.$URL.'/client/views/index.php');
}
