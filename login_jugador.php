<?php
    include 'app/config.php';
    include 'alert.php'; // Asegúrate de que la ruta sea correcta
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Jugadores - <?php echo APP_NAME; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root { --naranja-basket: #ff6600; --negro-pro: #1a1a1a; }
        body { 
            background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.8)), 
                        url('https://images.unsplash.com/photo-1546519638-68e109498ffc?q=80&w=1490&auto=format&fit=crop');
            background-size: cover; background-position: center;
            font-family: 'Poppins', sans-serif; min-height: 100vh;
            display: flex; align-items: center; justify-content: center; margin: 0;
        }
        .card-login { background: white; border-radius: 20px; width: 100%; max-width: 360px; margin: 20px; overflow: hidden; }
        .card-header { background: var(--negro-pro); color: var(--naranja-basket); text-align: center; padding: 2rem; border: none; }
        .logo-text { font-family: 'Bebas Neue', sans-serif; font-size: 2.5rem; margin: 0; }
        .btn-ingresar { 
            background-color: var(--naranja-basket); color: white; border: none; 
            font-weight: 600; padding: 12px; border-radius: 8px; transition: all 0.3s;
            text-transform: uppercase;
        }
        .btn-ingresar:hover { background-color: #e65c00; transform: translateY(-2px); shadow: 0 5px 15px rgba(255,102,0,0.3); }
        .form-control { border-radius: 8px; padding: 12px; }
    </style>
</head>
<body>

    <div class="card card-login shadow-lg">
        <div class="card-header">
            <h1 class="logo-text"><i class="bi bi-person-badge me-2"></i> PANEL JUGADOR</h1>
            <p class="text-white-50 small mb-0 text-uppercase">Ingresa tu correo registrado</p>
        </div>
        
        <div class="card-body p-4">
            <form action="app/controllers/controllers_jugador/controller_login_jugador.php" method="POST">
                <div class="mb-4">
                    <label class="form-label small fw-bold text-muted">Correo Electrónico</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-primary border-end-0"><i class="bi bi-envelope-fill"></i></span>
                        <input type="email" class="form-control border-start-0" name="email_jugador" placeholder="nombre@ejemplo.com" required>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-ingresar shadow-sm">Entrar a mi Perfil</button>
                </div>
            </form>

            <div class="text-center mt-4">
                <a href="index.php" class="text-muted small text-decoration-none">
                    <i class="bi bi-arrow-left"></i> Volver al Inicio
                </a>
            </div>
        </div>
    </div>

</body>
</html>