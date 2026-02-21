<?php
    include '../../config.php';
    session_start(); // Iniciamos la sesión al principio para evitar repeticiones

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $email = $_POST['email'];
        $user = $_POST['user'];
        $password = $_POST['password'];
        $tipo_usuario = $_POST['tipo_usuario'];

        // 1. Verificar si el correo ya existe
        $check_email = "SELECT * FROM usuarios WHERE email_usuario = ?";
        $query_check = $pdo->prepare($check_email);
        $query_check->execute([$email]);
        $existe = $query_check->fetch();

        if ($existe) {
            // Si el usuario ya existe, mandamos error y regresamos
            $_SESSION['mensaje'] = "El correo electrónico ya está registrado. Intenta con otro.";
            $_SESSION['color'] = "alert alert-warning";
            header('Location: '.$URL.'/register.php');
            exit(); // Detenemos la ejecución
        }

        // 2. Si no existe, procedemos al registro
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO usuarios (email_usuario, nombre_usuario, password_usuario, id_rol_fk) VALUES (?, ?, ?, ?)";
        
        $query = $pdo->prepare($sql);
        $query->bindParam(1, $email, PDO::PARAM_STR);
        $query->bindParam(2, $user, PDO::PARAM_STR);
        $query->bindParam(3, $hashed_password, PDO::PARAM_STR);
        $query->bindParam(4, $tipo_usuario, PDO::PARAM_STR);
        
        if($query->execute()){
            $_SESSION['mensaje'] = "Registro exitoso, ya puedes iniciar sesión";
            $_SESSION['color'] = "alert alert-success";
            header('Location: '.$URL.'/login.php'); // Podrías mandarlo al login de una vez
        } else {
            $_SESSION['mensaje'] = "Error al registrar, intenta nuevamente";
            $_SESSION['color'] = "alert alert-danger";
            header('Location: '.$URL.'/register.php');
        }
    }
?>