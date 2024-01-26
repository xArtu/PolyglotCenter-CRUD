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
        <h2 class="mt-5 center">Español</h2>
        <img class="mt-5" src="../../src/img/banderaEspanol.jpg" alt="Imagen de bandera de España">
        <p class="mt-5 texto">En Polyglot Center, entendemos la singular importancia del español como parte integral de nuestra oferta educativa. Aprender español en nuestros cursos no solo representa una oportunidad de adquirir una nueva lengua, sino que también abre las puertas a un mundo de beneficios y posibilidades en diversos aspectos de la vida. Aquí destacamos la relevancia del español en nuestros cursos:</p>
    </main>
    <article class="contenedor-medio">
        <section>
            <h3 class="mt-5"><strong>1. Comunicación Global y Profesional.</strong></h3 class="mt-5">
            <p class="mt-5 texto">El español es una lengua esencial en el ámbito de los negocios y la comunicación global. Muchas empresas buscan profesionales que dominen el español para facilitar relaciones comerciales y expandir su presencia en mercados hispanohablantes.</p>
            <h3 class="mt-5"><strong>2. Acceso a Diversidad Cultural.</strong></h3 class="mt-5">
            <p class="mt-5 texto">El español te conecta con una rica diversidad cultural que se extiende por América Latina, España y otras regiones del mundo. Aprender español es sumergirse en la riqueza de tradiciones, costumbres y expresiones artísticas que enriquecen la experiencia de vida.</p>
            <h3 class="mt-5"><strong>3. Viajes y Exploración.</strong></h3 class="mt-5" class="mt-5">
            <p class="mt-5 texto">Hablar español abre las puertas a emocionantes viajes y aventuras. Desde explorar ciudades históricas hasta disfrutar de playas paradisíacas, aprender español te permite sumergirte plenamente en la cultura y la belleza de los países de habla hispana.</p>
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

                    // Filtrar cursos de "Español"
                    if ($datosCurso[0] === "Español") {
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
