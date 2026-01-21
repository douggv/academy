<?php
    include '../config.php';
    $email = $_POST['email'];
    $password = $_POST['password']; 
    $rol = $_POST['tipo_usuario'];
    $sql = "SELECT * FROM usuarios WHERE email_usuario = ? AND id_rol_fk = ?";    
    $query = $pdo->prepare($sql);
    $query->bindParam(1, $email, PDO::PARAM_STR);
    $query->bindParam(2, $rol, PDO::PARAM_STR);
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
            session_start();
            $_SESSION['sesionojeador'] = $email;
            $_SESSION['rol'] = $rol;

            header('Location: '.$URL.'/client/ojeador/views/index.php');
        } elseif($rol == "2"){
            session_start();
            $_SESSION['sesioncoordinador'] = $email;
            $_SESSION['rol'] = $rol;

            header('Location: '.$URL.'/client/coordinador/views/index.php');
        } elseif($rol == "3"){
            session_start();
            $_SESSION['sesionentrenador'] = $email;
            $_SESSION['rol'] = $rol;

            header('Location: '.$URL.'/client/entrenador/views/index.php');
        }

            
    } else {
        session_start();
        $_SESSION['mensaje'] = "Error al iniciar sesion, verifique sus credenciales";
        $_SESSION['color'] = "alert alert-danger";
        header('Location: '.$URL.'/login.php');
    }
?>