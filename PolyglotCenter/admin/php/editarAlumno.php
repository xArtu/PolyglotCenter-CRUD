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

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["correo"])) {
    $correo_a_editar = $_GET["correo"];

    // Obtener los datos del alumno a editar
    $archivo_csv_alumno = "../../data/registroAlumno.csv";
    $contenido_csv_alumno = file_get_contents($archivo_csv_alumno);
    $lineas_alumno = explode(PHP_EOL, $contenido_csv_alumno);

    foreach ($lineas_alumno as $linea) {
        $datos = explode(",", $linea);
        if ($datos[3] == $correo_a_editar) {
            $nombre = $datos[0];
            $apellido1 = $datos[1];
            $apellido2 = $datos[2];
            $telefono = $datos[4];
            
            // Convertir el formato de la fecha
            $fechaNacimiento = (new DateTime($datos[5]))->format('Y-m-d');
            
            $contrasena = $datos[6];

            break;
        }
    }
} else {
    // Si no se proporciona un correo, redirigir a la lista de alumnos
    header("Location: listaAlumnos.php");
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
    <title>Editar Alumno</title>
</head>
<body class="bg">
    <main class="contenedor-medio mt-5">
        <h1 class="center" style="color:white">Editar Alumno</h1>
        <form action="./actualizarAlumno.php" method="post" class="formulario">

            <input type="hidden" name="correo_original" value="<?php echo $correo_a_editar; ?>">

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required value="<?php echo $nombre; ?>">
    
            <label for="apellido1">Apellido 1:</label>
            <input type="text" id="apellido1" name="apellido1" required value="<?php echo $apellido1; ?>">
    
            <label for="apellido2">Apellido 2:</label>
            <input type="text" id="apellido2" name="apellido2" required value="<?php echo $apellido2; ?>">
    
            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" required value="<?php echo $telefono; ?>">

            <label for="fechaNacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fechaNacimiento" name="fechaNacimiento" required value="<?php echo $fechaNacimiento; ?>">

            <!-- Campo oculto para mantener la contraseña original -->
            <input type="hidden" id="contrasena" name="contrasena" value="<?php echo $contrasena; ?>">

            <button type="submit" class="btn-registro">Actualizar Alumno</button>
        </form>
    </main>
    <footer class="mt-5"></footer>
</body>
</html>
