<?php
if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // 2. Carga única de configuración
    // Usamos require_once para que si ya se cargó en el index, no lo vuelva a intentar
require_once __DIR__ . '/../../../app/config.php';
if (!isset($_SESSION['id_jugador_sesion'])) {
    header('Location: ' . $URL . '/login_jugador.php');
    exit();
}
// Variables globales del jugador para usar en cualquier vista
$id_jugador_sesion = $_SESSION['id_jugador_sesion'];
$nombre_jugador_sesion = $_SESSION['nombre_jugador_sesion'];
?>