<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../../img/LOGO.png" type="image/x-icon">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .dashboard {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 220px;
            background: #343a40;
            color: white;
            padding: 20px 10px;
        }

        .sidebar h2 {
            font-size: 18px;
            margin-bottom: 20px;
            text-align: center;
        }

        .sidebar a {
            display: block;
            padding: 10px;
            margin: 5px 0;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .sidebar a:hover {
            background: #495057;
        }

        .content {
            flex-grow: 1;
            background: #f8f9fa;
            padding: 20px;
        }

        .header {
            background: #fff;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="dashboard">
        <!-- Incluir el componente del menú -->
        <?php include "./sidebar.php"; ?>

        <!-- Content -->
        <div class="content">
            <div class="header">
                <h3>Bienvenido al Dashboard</h3>
                <p>Aquí puedes administrar tu sistema.</p>
            </div>

            <div class="container">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Noticias</h5>
                                <p class="card-text">Gestiona las publicaciones de tu portal.</p>
                                <a href="./administrar_noticias.php" class="btn btn-primary btn-sm">Entrar</a>
                            </div>
                        </div>
                    </div>
                    <!-- Resto de las tarjetas (Usuarios, Reportes) -->
                    <div class="col-md-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Usuarios</h5>
                                <p class="card-text">Administra los usuarios y roles del sistema.</p>
                                <a href="./usuarios.php" class="btn btn-primary btn-sm">Entrar</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Reportes</h5>
                                <p class="card-text">Genera reportes de actividad y datos.</p>
                                <a href="./reportes.php" class="btn btn-primary btn-sm">Entrar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>