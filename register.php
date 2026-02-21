<?php
    include 'app/config.php';
?>

<?php
    // incluimos la alerta desde alert.php
    include 'alert.php';
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoops Academy - Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
   
    <link rel="icon" href="public/assets/img/logoBasquet2.png" type="image/png">
    <style>
        :root {
            --naranja-basket: #ff6600;
            --negro-pro: #1a1a1a;
        }

        body {
            background: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.75)), 
                        url('https://images.unsplash.com/photo-1504450758481-7338eba7524a?q=80&w=1469&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
        }

        .card-register {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 20px;
            border: none;
            box-shadow: 0px 20px 40px rgba(0, 0, 0, 0.4);
            width: 100%;
            max-width: 360px; /* Mismo ancho angosto */
        }

        .card-header {
            background-color: var(--negro-pro);
            color: var(--naranja-basket);
            text-align: center;
            padding: 1.2rem;
            border-radius: 20px 20px 0 0 !important;
            border: none;
        }

        .logo-text {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2rem;
            letter-spacing: 1px;
            margin: 0;
        }

        .btn-registrar {
            background-color: var(--naranja-basket);
            color: white;
            border: none;
            font-weight: 600;
            padding: 10px;
            border-radius: 8px;
            transition: all 0.3s ease;
            text-transform: uppercase;
        }

        .btn-registrar:hover {
            background-color: #e65c00;
            box-shadow: 0 5px 15px rgba(255, 102, 0, 0.4);
        }

        .form-control, .form-select {
            border-radius: 8px;
            font-size: 0.85rem;
            padding: 8px 12px;
        }

        .form-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .input-group-text {
            color: var(--naranja-basket);
            background-color: #f8f9fa;
        }

        .divider {
            height: 1px;
            background: #eee;
            margin: 1.2rem 0;
        }

        .link-login {
            color: var(--naranja-basket);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    <div class="card card-register">
        <div class="card-header">
            <h1 class="logo-text">ÚNETE AL EQUIPO</h1>
            <p class="text-white-50 mb-0 small">Crea tu perfil com ojeador <?php echo APP_NAME; ?></p>
        </div>
        
        <div class="card-body p-4">
            <form action="./app/controllers/controllers_ojeador/register.php" method="POST">
                

                <div class="mb-2">
                    <label class="form-label fw-bold">Correo Electrónico</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope-at"></i></span>
                        <input type="email" class="form-control" name="email" placeholder="correo@ejemplo.com" required>
                    </div>
                </div>

                <div class="mb-2">
                    <label class="form-label fw-bold">Nombre de Usuario</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-at"></i></span>
                        <input type="text" class="form-control" name="user" placeholder="usuario123" required>
                    </div>
                </div>

               <input name="tipo_usuario" type="hidden" value="1">

                <div class="mb-4">
                    <label class="form-label fw-bold">Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" class="form-control" name="password" placeholder="Mínimo 8 caracteres" required>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-registrar">SALTAR A LA CANCHA</button>
                </div>
            </form>

            <div class="divider"></div>

            <div class="text-center">
                <p class="small mb-0">¿Ya eres parte de la academia?</p>
                <a href="login.php" class="link-login">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Iniciar Sesión aquí
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>