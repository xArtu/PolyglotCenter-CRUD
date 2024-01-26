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
    <title>Listado de Grupos</title>
</head>
<body>
<?php
// Obtener el contenido del archivo CSV de grupos
$ruta_csv_grupo = "../../data/grupo.csv";
$contenido_csv_grupo = file_get_contents($ruta_csv_grupo);
$lineas_grupo = explode(PHP_EOL, $contenido_csv_grupo);
echo '<div class="contenedor">';
// Mostrar la lista de grupos con opción para editar y eliminar
echo '<table class="listado">';
echo '<tr>';
echo '<th>Curso</th>';
echo '<th>Nivel</th>';
echo '<th>Fecha de Inicio</th>';
echo '<th>Fecha de Fin</th>';
echo '<th>Profesor</th>';
echo '<th>Capacidad</th>';
echo '<th>Editar</th>';
echo '<th>Eliminar</th>'; // Agregado para eliminar
echo '</tr>';

// Comenzar desde el segundo renglón (índice 1)
for ($i = 1; $i < count($lineas_grupo); $i++) {
    $linea = $lineas_grupo[$i];
    if (!empty($linea)) {
        $datos = explode(",", $linea);
        echo '<tr>';
        echo '<td>' . $datos[1] . '</td>';
        echo '<td>' . $datos[2] . '</td>';
        echo '<td>' . $datos[3] . '</td>';
        echo '<td>' . $datos[4] . '</td>';
        echo '<td>' . $datos[5] . ' ' . $datos[6] . '</td>';
        echo '<td>' . $datos[7] . '</td>';
        echo '<td class="editar"><a class="link" href="editarGrupo.php?id=' . $datos[0] . '">Editar</a></td>'; // Modificado para incluir el ID
        echo '<td class="eliminar"><a class="link" href="eliminarGrupo.php?id=' . $datos[0] . '">Eliminar</a></td>'; // Modificado para incluir el ID
        echo '</tr>';
    }
}

echo '</table>';
echo '</div>';
?>

</body>
</html>