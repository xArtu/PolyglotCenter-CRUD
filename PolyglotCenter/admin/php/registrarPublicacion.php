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
    <link rel="stylesheet" href="../../src/styles/normalize.css">
    <link rel="stylesheet" href="../../src/styles/style.css">
    <title>Registro</title>
</head>
<body class="bg">
    <main class="contenedor-medio">
        <h1 class="center" style="color:white">Crear publicación</h1>
        <form action="subirPublicacion.php" method="post" class="formulario">

<label for="autor">Autor:</label>
<input type="text" id="autor" name="autor" required placeholder="Nombre del autor" value="admin">

<label for="contenido">Contenido:</label>
<textarea id="contenido" name="contenido" required placeholder="Escribe tu publicación"></textarea>

<label for="fechaPublicacion">Fecha de Publicación:</label>
<input type="date" id="fechaPublicacion" name="fechaPublicacion" required value="<?php echo date('Y-m-d'); ?>">

<button type="submit" class="btn-registro">Crear Publicación</button>
</form>
    </main>
    <footer class="mt-5">

    </footer>
</body>
</html>