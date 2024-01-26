<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/styles/normalize.css">
    <link rel="stylesheet" href="../src/styles/style.css">
    <title>Cursos | Polyglot Center</title>
</head>
<body>
    <div class="contenedorNavegacion">
        <h1 class="titulo">Polyglot Center</h1>
        <nav class="">
            <ul class="opciones">
                <li><a href="../index.html" class="link">Inicio</a></li>
                <li><a href="cursos.php" class="link">Cursos</a></li>
                <li><a href="nosotros.html" class="link">Nosotros</a></li>
                <li><a href="" class="link">Contacto</a></li>
            </ul>
        </nav>
        <div class="sesion">
            <ul>
                <li><a href="" class="link">Iniciar sesión</a></li>
            </ul> 
        </div>
    </div>
    <h2 class="center mt-5">Cursos disponibles</h2>
    <main class="contenedor contenedor-grid">
    <?php
    // Ruta al archivo grupo.csv (ajusta la ruta según tu estructura de archivos)
    $archivoCursos = "../data/grupo.csv";

    // Verificar si el archivo existe
    if (file_exists($archivoCursos)) {
        // Leer el contenido del archivo CSV
        $contenidoCursos = file($archivoCursos, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        // Iterar sobre las líneas del archivo CSV, empezando desde la segunda línea (índice 1)
        for ($i = 1; $i < count($contenidoCursos); $i++) {
            // Separar los campos de la línea
            $datosCurso = explode(",", $contenidoCursos[$i]);

            // Imprimir información en un formato específico
            echo "<div class='card-curso'>";
            echo "<h2>{$datosCurso[1]}</h2>";
            echo "<h3>Nivel: {$datosCurso[2]}</h3>";
            echo "<p><strong>Fecha de inicio</strong>: {$datosCurso[3]}</p>";
            echo "<p><strong>Fecha de fin</strong>: {$datosCurso[4]}</p>";
            echo "<p><strong>Profesor</strong>: {$datosCurso[5]} {$datosCurso[6]}</p>";
            echo "<p><strong>Capacidad</strong>: {$datosCurso[7]}</p>";
            echo "</div>";
        }
    } else {
        echo "<p>No se encontró el archivo de cursos.</p>";
    }
    ?>
</main>

    <footer class="contenedorNavegacion mt-5">
        <p class="titulo">© 2024 Polyglot Center</p>
        <nav>
            <ul class="opciones">
                <li><a href="../index.html" class="link">Inicio</a></li>
                <li><a href="cursos.php" class="link">Cursos</a></li>
                <li><a href="nosotros.html" class="link">Nosotros</a></li>
                <li><a href="" class="link">Contacto</a></li>
            </ul>
        </nav>
        <p class="sesion slogan">"Promoviendo la comunicación efectiva"</p>
    </footer>
</body>
</html>
