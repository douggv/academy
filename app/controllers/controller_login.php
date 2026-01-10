<?php
    include '../config.php';
    $email = $_POST['email'];
    $password = $_POST['password'];    
    $sql = "SELECT * FROM usuarios WHERE email_usuario = ?";    
    $query = $pdo->prepare($sql);
    $query->bindParam(1, $email, PDO::PARAM_STR);
    $query->execute();
    $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);
    $contador = 0;
    foreach ($usuarios as $usuario) {
        $rol = $usuario['id_rol_fk'];
        $passwod_tabla = $usuario['password_usuario'];
        if (password_verify($password, $passwod_tabla)) {
            $contador = $contador + 1;
        }
    }
    
    if($contador > 0){
        // verificamos los roles : 1 = ojeador, 3 coordinador, 4 entrenador
        if($rol == "1"){
            $_SESSION['sesion'] = $email;
            header('Location: '.$URL.'/client/ojeador/index.php');
        } elseif($rol == "3"){
            $_SESSION['sesion'] = $email;
            header('Location: '.$URL.'/client/coordinador/index.php');
        } elseif($rol == "4"){
            $_SESSION['sesion'] = $email;
            header('Location: '.$URL.'/client/entrenador/index.php');
        }

            
    } else {
        session_start();
        $_SESSION['mensaje'] = "Error al iniciar sesion, verifique sus credenciales";
        $_SESSION['color'] = "alert alert-danger";
        header('Location: '.$URL.'/login.php');
    }
?>