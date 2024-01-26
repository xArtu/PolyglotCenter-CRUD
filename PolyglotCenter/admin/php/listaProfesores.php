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
    <title>Listado Profesores</title>
</head>
<body>
<?php
$archivo_csv_profesor = "../../data/registroProfesor.csv";
$contenido_csv_profesor = file_get_contents($archivo_csv_profesor);
$lineas_profesor = explode(PHP_EOL, $contenido_csv_profesor);
echo '<div class="contenedor">';
// Mostrar la lista de profesores con opción para editar
echo '<table class="listado">';
foreach ($lineas_profesor as $indice => $linea) {
    if ($indice == 0) {
        // Encabezado: solo imprimir Nombre, Apellido1, Apellido2, Correo
        echo '<tr>';
        echo '<th>Nombre</th>';
        echo '<th>Apellido1</th>';
        echo '<th>Apellido2</th>';
        echo '<th>Correo</th>';
        echo '<th>Editar</th>';
        echo '<th>Eliminar</th>';
        echo '</tr>';
    } elseif (!empty($linea)) {
        // Datos del profesor: solo imprimir Nombre, Apellido1, Apellido2, Correo
        $datos = explode(",", $linea);
        echo '<tr>';
        echo '<td>' . $datos[0] . '</td>';
        echo '<td>' . $datos[1] . '</td>';
        echo '<td>' . $datos[2] . '</td>';
        echo '<td>' . $datos[3] . '</td>';
        echo '<td class="editar"><a class="link" href="editarProfesor.php?correo=' . $datos[3] . '">Editar</a></td>';
        echo '<td class="eliminar"><a class="link" href="eliminarProfesor.php?correo=' . $datos[3] . '">Eliminar</a></td>';
        echo '</tr>';
    }
}
echo '</table>';
echo '</div>';
?>

</body>
</html>