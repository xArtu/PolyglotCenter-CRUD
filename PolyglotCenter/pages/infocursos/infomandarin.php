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
        <h2 class="mt-5 center">Mandarín</h2>
        <img class="mt-5" src="../../src/img/banderaMandarin.jpg" alt="Imagen de bandera de China">
        <p class="mt-5 texto">En Polyglot Center, reconocemos la singular importancia del mandarín como parte integral de nuestra oferta educativa. Aprender mandarín en nuestros cursos no solo representa una oportunidad de adquirir una nueva lengua, sino que también abre las puertas a un mundo de beneficios y posibilidades en diversos aspectos de la vida. Aquí destacamos la relevancia del mandarín en nuestros cursos:</p>
    </main>
    <article class="contenedor-medio">
        <section>
            <h3 class="mt-5"><strong>1. Oportunidades en el Ámbito Comercial.</strong></h3 class="mt-5">
            <p class="mt-5 texto">El mandarín es esencial en el ámbito empresarial, especialmente dada la importancia de China en la economía global. Aprender mandarín puede abrir puertas a oportunidades comerciales y colaboraciones internacionales.</p>
            <h3 class="mt-5"><strong>2. Acceso a una Cultura Centenaria.</strong></h3 class="mt-5">
            <p class="mt-5 texto">El mandarín es la llave para comprender la rica historia y cultura china que abarca miles de años. Aprender el idioma te permite sumergirte en la profundidad de las tradiciones, el arte y la filosofía chinas.</p>
            <h3 class="mt-5"><strong>3. Desarrollo de Conexiones Personales y Profesionales.</strong></h3 class="mt-5" class="mt-5">
            <p class="mt-5 texto">Hablar mandarín facilita la creación de conexiones significativas con hablantes nativos, tanto a nivel personal como profesional, mejorando la comunicación y entendimiento mutuo.</p>
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
    
                        // Filtrar cursos de "Mandarín"
                        if ($datosCurso[0] === "Mandarín") {
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
