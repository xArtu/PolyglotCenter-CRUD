<?php
    session_start(); // Iniciar la sesión al principio de cada página
    if (!isset($_SESSION['rol_usuario'])) {
        // Si no hay una sesión activa, redirigir a la página de inicio de sesión
        header("Location: ../iniciarSesion.html");
        exit();
    }
    
    // Verificar el rol permitido para esta página
    $rol_permitido = 'admin'; // Puedes establecer el rol permitido para cada página
    if ($_SESSION['rol_usuario'] !== $rol_permitido) {
        // Si el rol no es el permitido, redirigir a una página de acceso no autorizado
        header("Location: ../accesoNoAutorizado.html");
        exit();
    }    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/styles/normalize.css">
    <link rel="stylesheet" href="../src/styles/style.css">
    <title>Inicio administrador</title>
</head>
<body>
    <h1 class="center mt-5">Modo administrador</h1>
    <main class="contenedor">
        <h2 class="mt-5 center">Administrar profesor</h2>
        <div class="contenedor-admin mt-5">
            <div>
                <h3><a href="registroProfesor.php" class="link">Agregar</a></h3>
            </div>
            <div>
                <h3><a href="./php/listaProfesores.php" class="link">Actualizar</a></h3>
            </div>
            <div>
                <h3><a href="./php/listaProfesores.php" class="link">Eliminar</a></h3>
            </div>
        </div>
        <h2 class="mt-5 center">Administrar alumno</h2>
        <div class="contenedor-admin mt-5">
            <div>
                <h3><a href="./php/registrarAlumno.php" class="link">Agregar</a></h3>
            </div>
            <div>
                <h3><a href="./php/listadoAlumno.php" class="link">Actualizar</a></h3>
            </div>
            <div>
                <h3><a href="./php/listadoAlumno.php" class="link">Eliminar</a></h3>
            </div>
        </div>
        <h2 class="mt-5 center">Administrar grupo</h2>
        <div class="contenedor-admin mt-5">
            <div>
                <h3><a href="registroGrupo.php" class="link">Agregar</a></h3>
            </div>
            <div>
                <h3><a href="./php/listadoGrupo.php" class="link">Actualizar</a></h3>
            </div>
            <div>
                <h3><a href="./php/listadoGrupo.php" class="link">Eliminar</a></h3>
            </div>
        </div>
        <h2 class="mt-5 center">Administrar publicaciones</h2>
        <div class="contenedor-admin mt-5">
            <div>
                <h3><a href="./php/registrarPublicacion.php" class="link">Agregar</a></h3>
            </div>
            <div>
                <h3><a href="./php/listadoPublicacion.php" class="link">Eliminar</a></h3>
            </div>
        </div>
    </main>
    <footer class="mt-5"></footer>
</body>
</html>