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
    <title>APP_NAME</title>
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
            margin: 0;
        }

        .card-login {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 20px;
            border: none;
            box-shadow: 0px 20px 40px rgba(0, 0, 0, 0.4);
            /* Ancho más angosto solicitado */
            width: 100%;
            max-width: 360px; 
            margin: 20px;
        }

        .card-header {
            background-color: var(--negro-pro);
            color: var(--naranja-basket);
            text-align: center;
            padding: 1.5rem;
            border-radius: 20px 20px 0 0 !important;
            border: none;
        }

        .logo-text {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2.2rem;
            letter-spacing: 1px;
            margin: 0;
        }

        .btn-ingresar {
            background-color: var(--naranja-basket);
            color: white;
            border: none;
            font-weight: 600;
            padding: 10px;
            border-radius: 8px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-ingresar:hover {
            background-color: #e65c00;
            box-shadow: 0 5px 15px rgba(255, 102, 0, 0.4);
            transform: translateY(-1px);
        }

        .form-control, .form-select {
            border-radius: 8px;
            padding: 10px 12px;
            border: 1px solid #ddd;
            font-size: 0.9rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--naranja-basket);
            box-shadow: 0 0 0 0.25rem rgba(255, 102, 0, 0.15);
        }

        .input-group-text {
            background-color: #f8f9fa;
            border-radius: 8px 0 0 8px;
            color: var(--naranja-basket);
        }

        .links-footer a {
            color: var(--naranja-basket);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.85rem;
        }

        .links-footer a:hover {
            text-decoration: underline;
        }

        .divider {
            height: 1px;
            background: #eee;
            margin: 1.5rem 0;
        }
    </style>
</head>
<body>

    <div class="card card-login">
        <div class="card-header">
            <h1 class="logo-text">
                <i class="bi bi-basketball me-2"></i> 
            </h1>
            <small class="text-uppercase tracking-widest" style="font-size: 0.7rem; color: #aaa;"><?php echo APP_NAME; ?></small>
        </div>
        
        <div class="card-body p-4">
            <form action="app/controllers/controller_login.php" method="POST">
                
                <div class="mb-3">
                    <label class="form-label small fw-bold">Usuario</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                        <input type="email" class="form-control" name="email" placeholder="Ej: kobe24" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold">Rol en la Academia</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-shield-lock-fill"></i></span>
                        <select class="form-select" name="tipo_usuario" required>
                            <option value="" selected disabled>Seleccionar...</option>
                            <option value="2">Coordinador</option>
                            <option value="1">Ojeador</option>
                            <option value="3">Entrenador</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label small fw-bold">Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                        <input type="password" class="form-control" name="password" placeholder="********" required>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-ingresar">Entrar a la Cancha</button>
                </div>
            </form>

            <div class="divider"></div>

            <div class="links-footer text-center">
                <p class="mb-2"><a href="recuperar.php">¿Olvidaste tu contraseña?</a></p>
                <p class="mb-2">¿Eres nuevo? <a href="register.php">Crea tu cuenta</a></p>
                <p class="mt-3 pt-2 border-top">
                    <a href="login.php" class="text-muted small">
                        <i class="bi bi-arrow-left-circle me-1"></i>Regresar al inicio
                    </a>
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>