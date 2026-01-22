<?php
    include '../../../config.php';
?>
<?php
    // si es pots 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $directorio_destino = __DIR__ . "/../../../../client/assets/img/jugadores/";
        // recoger los datos del formulario
        $nombre_jugador = $_POST['nombre_jugador'];
        $email_jugador = $_POST['email_jugador'];
        $altura_jugador = $_POST['altura_jugador'];
        $peso_jugador = $_POST['peso_jugador'];
        $id_universidad_fk = $_POST['id_universidad_fk'];
        
        // manejar la subida de la imagen lo guardamos en la ruta raiz 

       if (isset($_FILES['imagen_jugador']) && $_FILES['imagen_jugador']['error'] == 0) {
    
    // 1. Creamos el nombre del archivo
    $imagen_nombre = $nombre_jugador . '_' . time() . '_' . $_FILES['imagen_jugador']['name'];

    // 2. RUTA FÍSICA (Para mover el archivo al disco duro)
    // Usamos __DIR__ para que PHP sepa exactamente dónde está parado el servidor
    $directorio_destino = __DIR__ . "/../../../../client/assets/img/jugadores/";

    // 3. Ejecutamos el movimiento del archivo
    if (move_uploaded_file($_FILES['imagen_jugador']['tmp_name'], $directorio_destino . $imagen_nombre)) {
        
        // 4. RUTA PARA LA BASE DE DATOS (Usando tu variable $URL)
        // Esto es lo que guardarás en el campo 'foto' de tu SQL
        $imagen_para_db = $URL . '/client/assets/img/jugadores/' . $imagen_nombre;
        
    } else {
        // Si falla el movimiento, podrías poner una imagen por defecto
        $imagen_para_db = $URL . '/client/assets/img/jugadores/default.png';
    }

    } else {
        // Si no se subió nada o hubo error
        $imagen_para_db = $URL . '/client/assets/img/jugadores/default.png';
    }
        
        // preparar la consulta SQL         

        $sql = "INSERT INTO jugadores (nombre_jugador, email_jugador, altura_jugador, peso_jugador, imagen_jugador, id_universidad_fk) 
                VALUES (:nombre_jugador, :email_jugador, :altura_jugador, :peso_jugador, :imagen_jugador, :id_universidad_fk)";
        
        $query = $pdo->prepare($sql);
        
        // enlazar los parámetros
        $query->bindParam(':nombre_jugador', $nombre_jugador);
        $query->bindParam(':email_jugador', $email_jugador);
        $query->bindParam(':altura_jugador', $altura_jugador);
        $query->bindParam(':peso_jugador', $peso_jugador);
        $query->bindParam(':imagen_jugador', $imagen_nombre);
        $query->bindParam(':id_universidad_fk', $id_universidad_fk);
        
        // ejecutar la consulta
        if($query->execute()){
            // redirigir al listado de jugadores con éxito
            session_start();
            $_SESSION['mensaje'] = 'jugador_creado';
            $_SESSION['icon_mensaje'] = 'success';
            header('Location: '.$URL.'/client/entrenador/views/jugadores/index.php?mensaje=jugador_creado');
            exit();
        } else {
            session_start();
            $_SESSION['mensaje'] = 'error al crear jugador';
            $_SESSION['icon_mensaje'] = 'error';
            // redirigir con error
            header('Location: '.$URL.'/client/entrenador/views/jugadores/create.php?error=error_creacion');
            exit();
        }
    } else {
        // si no es post redirigir al formulario
        header('Location:   '.$URL.'/client/entrenador/views/jugadores/create.php');
        exit();
    }
?>