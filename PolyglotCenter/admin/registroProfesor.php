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
    <title>Registro</title>
</head>
<body class="bg">
    <main class="contenedor-medio">
        <h1 class="center" style="color:white">Registro profesor</h1>
        <form action="./php/registrarProfesor.php" method="post" class="formulario">
 
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required placeholder="Escribe el nombre">
    
            <label for="apellido1">Apellido 1:</label>
            <input type="text" id="apellido1" name="apellido1" required placeholder="Escribe el primer apellido">
    
            <label for="apellido2">Apellido 2:</label>
            <input type="text" id="apellido2" name="apellido2" required placeholder="Escribe el segundo apellido">
    
            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" required placeholder="Escribe el correo electrónico">
    
            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" required placeholder="Escribe el número de teléfono">

            <label for="cedula">Cédula:</label>
            <input type="text" id="cedula" name="cedula" required placeholder="Escribe la cédula">

            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required placeholder="********">
    
            <button type="submit" class="btn-registro">Registrar Profesor</button>
        </form>
    </main>
</body>
</html>