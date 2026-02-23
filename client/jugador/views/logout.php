
<?php 
// destruir la sesión del jugador
session_start();
session_unset();
session_destroy();
// Redirigir al inicio con mensaje de éxito
include '../../../app/config.php';
session_start();
$_SESSION['mensaje'] = "Has cerrado sesión exitosamente.";
$_SESSION['color'] = "alert-success";
header('Location: ' . $URL . '/login_jugador.php');
exit();
