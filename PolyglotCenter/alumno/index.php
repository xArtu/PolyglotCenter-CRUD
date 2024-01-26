<?php
session_start();

if (!isset($_SESSION['rol_usuario'])) {
    // Si no hay una sesión activa, redirigir a la página de inicio de sesión
    header("Location: ../iniciarSesion.html");
    exit();
}

// Verificar el rol permitido para esta página
$rol_permitido = 'alumno';
if ($_SESSION['rol_usuario'] !== $rol_permitido) {
    // Si el rol no es el permitido, redirigir a una página de acceso no autorizado
    header("Location: ../accesoNoAutorizado.html");
    exit();
}

// Verificar si la información del usuario está en la sesión
if (isset($_SESSION['nombre']) && isset($_SESSION['apellido'])) {
    $nombre = $_SESSION['nombre'];
    $apellido = $_SESSION['apellido'];
} else {
    // Si no hay información del usuario en la sesión, redirigir a la página de inicio de sesión
    header("Location: ../iniciarSesion.html");
    exit();
}
    $correo = $_SESSION['correo'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/styles/normalize.css">
    <link rel="stylesheet" href="../src/styles/style.css">
    <title>Inicio alumno</title>
</head>
<body class="">
    <!-- <h1 class="center mt-5">Bienvenido <?php echo $nombre . ' ' . $apellido; ?></h1> -->
    <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="contenedorNavegacion">
    <h1 class="titulo">Polyglot Center</h1>
    <nav>
        <ul class="opciones">
            <li><a href="index.html" class="link">Inicio</a></li>
            <li><a href="" class="link">Mis cursos</a></li>
        </ul>
    </nav>
    <div class="sesion">
        <ul>
            <li>
                <a href="#" class="link"><?php echo $nombre . ' ' . $apellido; ?></a>
                <ul class="submenu">
                    <li><a href="perfil.php" class="link">Perfil</a></li>
                    <li><a href="../php/cerrarSesion.php" class="link">Cerrar sesión</a></li>
                </ul>
            </li>
        </ul> 
    </div>
</div>
<main>
    <div class="contenedor">
        <h1 class="center mt-5">Bienvenido</h1>
    </div>
</main>


</body>
</html>



</body>
</html>
