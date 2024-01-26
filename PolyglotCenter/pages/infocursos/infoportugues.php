<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../src/styles/normalize.css">
    <link rel="stylesheet" href="../../src/styles/style.css">
    <title>Nosotros | Polyglot Center</title>
</head>
<body>
    <header class="contenedorNavegacion">
        <h1 class="titulo">Polyglot Center</h1>
        <nav class="">
            <ul class="opciones">
                <li><a href="../../index.html" class="link">Inicio</a></li>
                <li><a href="../pages/cursos.php" class="link">Cursos</a></li>
                <li><a href="../pages/nosotros.html" class="link">Nosotros</a></li>
                <li><a href="" class="link">Contacto</a></li>
            </ul>
        </nav>
        <div class="sesion">
            <ul>
                <li><a href="" class="link">Iniciar sesión</a></li>
            </ul> 
        </div>
    </header>
    <main class="contenedor-medio">
        <h2 class="mt-5 center">Portugués</h2>
        <img class="mt-5" src="../../src/img/banderaPortugues.jpg" alt="Imagen de bandera de Brasil">
        <p class="mt-5 texto">En Polyglot Center, reconocemos la singular importancia del portugués como parte integral de nuestra oferta educativa. Aprender portugués en nuestros cursos no solo representa una oportunidad de adquirir una nueva lengua, sino que también abre las puertas a un mundo de beneficios y posibilidades en diversos aspectos de la vida. Aquí destacamos la relevancia del portugués en nuestros cursos:</p>
    </main>
    <article class="contenedor-medio">
        <section>
            <h3 class="mt-5"><strong>1. Vínculos Comerciales en América Latina.</strong></h3 class="mt-5">
            <p class="mt-5 texto">El portugués es esencial para aquellos que buscan establecer vínculos comerciales en América Latina, especialmente en Brasil. Aprender portugués puede facilitar la comunicación y colaboración en este mercado en expansión.</p>
            <h3 class="mt-5"><strong>2. Exploración de la Cultura Brasileña.</strong></h3 class="mt-5">
            <p class="mt-5 texto">Aprender portugués te sumerge en la riqueza cultural de Brasil, desde su música vibrante hasta sus festivales coloridos. Conocer el idioma amplifica la experiencia de explorar la diversidad y la hospitalidad brasileñas.</p>
            <h3 class="mt-5"><strong>3. Ampliación de Redes Personales y Profesionales.</strong></h3 class="mt-5" class="mt-5">
            <p class="mt-5 texto">Hablar portugués abre la puerta a la creación de conexiones significativas en América Latina y más allá. Facilita la construcción de relaciones personales y profesionales en un entorno globalizado.</p>
        </section>
        <section>
        <h3 class="mt-5">Cursos disponibles</h3>
        <div class="contenedor-grid">
            <?php
            // Ruta al archivo grupo.csv (ajusta la ruta según tu estructura de archivos)
            $archivoCursos = "../../data/grupo.csv";

            // Verificar si el archivo existe
            if (file_exists($archivoCursos)) {
                // Leer el contenido del archivo CSV
                $contenidoCursos = file($archivoCursos, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

                // Iterar sobre las líneas del archivo CSV
                foreach ($contenidoCursos as $curso) {
                    // Separar los campos de la línea
                    $datosCurso = explode(",", $curso);

                    // Filtrar cursos de "Alemán"
                    if ($datosCurso[0] === "Portugués") {
                        // Imprimir la información en una card
                        echo "<div class='card-curso'>";
                        echo "<h2>{$datosCurso[0]}</h2>";
                        echo "<h3>Nivel: {$datosCurso[1]}</h3>";
                        echo "<p><strong>Fecha de inicio</strong>: {$datosCurso[2]}</p>";
                        echo "<p><strong>Fecha de fin</strong>: {$datosCurso[3]}</p>";
                        echo "<p><strong>Profesor</strong>: {$datosCurso[4]} {$datosCurso[5]}</p>";
                        echo "<p><strong>Capacidad</strong>: {$datosCurso[6]}</p>";
                        echo "</div>";
                    }
                }
            } else {
                echo "<p>No se encontró el archivo de cursos.</p>";
            }
            ?>

        </div>
    </section>
    </article>

    <footer class="contenedorNavegacion mt-5">
        <p class="titulo">© 2024 Polyglot Center</p>
        <nav>
            <ul class="opciones">
                <li><a href="../../index.html" class="link">Inicio</a></li>
                <li><a href="../pages/cursos.php" class="link">Cursos</a></li>
                <li><a href="../pages/nosotros.html" class="link">Nosotros</a></li>
                <li><a href="" class="link">Contacto</a></li>
            </ul>
        </nav>
        <p class="sesion slogan">"Promoviendo la comunicación efectiva"</p>
    </footer>
</body>
</html>
