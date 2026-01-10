<?php
    include '../../config.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $email = $_POST['email'];
        $user = $_POST['user'];
        $password = $_POST['password'];
        $tipo_usuario = $_POST['tipo_usuario'];
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO usuarios (email_usuario, nombre_usuario, password_usuario, id_rol_fk) VALUES (?, ?, ?, ?)";
        
        $query = $pdo->prepare($sql);
        $query->bindParam(1, $email, PDO::PARAM_STR);
        $query->bindParam(2, $user, PDO::PARAM_STR);
        $query->bindParam(3, $hashed_password, PDO::PARAM_STR);
        $query->bindParam(4, $tipo_usuario, PDO::PARAM_STR);
        $result = $query->execute();

        if($result){
            session_start();
            $_SESSION['mensaje'] = "Registro exitoso, ya puedes iniciar sesión";
            $_SESSION['color'] = "alert alert-success";
            header('Location: '.$URL.'/register.php');
        } else {
            session_start();
            $_SESSION['mensaje'] = "Error al registrar, intenta nuevamente";
            $_SESSION['color'] = "alert alert-danger";
            header('Location: '.$URL.'/register.php');
        }
    }
?>
