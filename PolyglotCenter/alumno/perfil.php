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
    <div class="contenedorNavegacion">
        <h1 class="titulo">Polyglot Center</h1>
        <nav>
            <ul class="opciones">
                <li><a href="index.html" class="link">Inicio</a></li>
                <li><a href="" class="link">Mis cursos</a></li>
                <li><a href="" class="link">Historial académico</a></li>
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
            <h1 class="center mt-5">Tus datos</h1>
            <table class="table mt-5">
                <?php
                
                // Ruta al archivo CSV
                $ruta_csv = "../data/registroAlumno.csv";

                // Verificar si el archivo existe
                if (file_exists($ruta_csv)) {
                    // Leer el contenido del archivo CSV
                    $contenido_csv = file_get_contents($ruta_csv);

                    // Dividir el contenido en líneas
                    $lineas = explode(PHP_EOL, $contenido_csv);

                    // Iterar sobre las líneas
                    foreach ($lineas as $linea) {
                        // Dividir los datos en cada línea por el punto y coma
                        $datos = explode(",", $linea);

                        // Verificar si hay datos y si el correo coincide con el del usuario
                        if (!empty($datos) && $datos[3] == $correo) {
                            echo '<tr>';
                            // Iterar sobre los datos y mostrarlos en una tabla
                            
                            echo '<th>' . "Nombre" . '</th>';
                            echo '<th>' . "Apellido 1" . '</th>';
                            echo '<th>' . "Apellido 2" . '</th>';
                            echo '<th>' . "Correo" . '</th>';
                            echo '<th>' . "Teléfono" . '</th>';
                            echo '<th>' . "Fecha de Nacimiento" . '</th>';
                            
                            echo '</tr>';
                            echo '<tr>';
                            for ($i = 0; $i < count($datos)-2; $i++) {
                                echo '<td>' . $datos[$i] . '</td>';
                            }
                            echo '</tr>';
                            break;
                        }
                    }
                } else {
                    echo "El archivo CSV no existe.";
                }
                ?>
            </table>
        </div>
    </main>
    <article>
        <section class="contenedor">
            <h2 class="center mt-5">Historial global</h2>
        </section>
    </article>
</body>
</html>
