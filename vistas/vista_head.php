<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <!-- css boostrap -->
    <link rel="stylesheet" href='public/css/bootstrap.min.css'>

    <!-- css mis estilos -->
    <link rel="stylesheet" href="public/css/styles.css">

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Inicio
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="usuarios.php">Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="empleados.php">Empleados</a>
                </li>
           
            </ul>
            <ul class="form-inline my-2 my-lg-0">
                <a href="includes/logout.php" class="btn btn-danger my-2 my-sm-0" type="submit">Salir</a>
            </ul>
        </div>
    </nav>
    <div class="container">