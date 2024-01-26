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

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id_a_editar = $_GET["id"];

    // Obtener los datos del grupo a editar
    $archivo_csv_grupo = "../../data/grupo.csv";
    $contenido_csv_grupo = file_get_contents($archivo_csv_grupo);
    $lineas_grupo = explode(PHP_EOL, $contenido_csv_grupo);

    foreach ($lineas_grupo as $linea) {
        $datos = explode(",", $linea);
        if ($datos[0] == $id_a_editar) {
            $curso = $datos[1];
            $nivel = $datos[2];
            $fechaInicio = (new DateTime($datos[3]))->format('Y-m-d');
            $fechaFin = (new DateTime($datos[4]))->format('Y-m-d');
            $nombre = $datos[5];
            $apellido1 = $datos[6];
            $capacidad = $datos[7];
            break;
        }
    }
} else {
    header("Location: listaGrupos.php");
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Actualizar Grupo</title>
</head>
<body class="bg">
    <main class="contenedor-medio">
        <h1 class="center" style="color:white">Actualizar Grupo de Clase</h1>
        <form action="actualizarGrupo.php" method="post" class="formulario" id="editarGrupoForm">

            <label for="curso">Curso:</label>
            <input type="text" id="curso" name="curso" required value="<?php echo $curso; ?>" readonly>

            <label for="nivel">Nivel:</label>
            <input type="text" id="nivel" name="nivel" required value="<?php echo $nivel; ?>" readonly>

            <label for="fechaInicio">Fecha de Inicio:</label>
            <input type="date" id="fechaInicio" name="fechaInicio" required value="<?php echo $fechaInicio; ?>">

            <label for="fechaFin">Fecha de Fin:</label>
            <input type="date" id="fechaFin" name="fechaFin" required value="<?php echo $fechaFin; ?>">

            <label for="listaProfesores">Lista de Profesores:</label>
            <!-- Agrega opciones al select con JavaScript -->
            <select id="listaProfesores" name="listaProfesores" required></select>

            <label for="capacidad">Capacidad:</label>
            <input type="number" id="capacidad" name="capacidad" required value="<?php echo $capacidad; ?>">

            <input type="hidden" name="grupo_id" value="<?php echo $id_a_editar; ?>">

            <button type="submit" class="btn-registro">Actualizar Grupo</button>
        </form>
    </main>
    <footer class="mt-5"></footer>
    <script>
        $(document).ready(function () {
            // Cargar las opciones de profesores al cargar la página
            cargarOpcionesProfesores();
        });

        // Función para cargar las opciones de profesores
        function cargarOpcionesProfesores() {
            $.ajax({
                type: "GET",
                url: "../../data/registroProfesor.csv",
                dataType: "text",
                success: function (data) {
                    var lines = data.split("\n");
                    var nombresProfesores = [];

                    for (var i = 1; i < lines.length; i++) {
                        var cells = lines[i].split(",");
                        
                        // Verificar si hay suficientes columnas antes de acceder a trim
                        if (cells.length >= 2) {
                            var nombreCompleto = (cells[0].trim() + " " + cells[1].trim()).trim();
                            nombresProfesores.push(nombreCompleto);
                        }
                    }

                    // Eliminar duplicados y agregar opciones al select
                    $.each([...new Set(nombresProfesores)], function (index, value) {
                        $('#listaProfesores').append($('<option>', {
                            value: value,
                            text: value
                        }));
                    });

                    // Seleccionar el profesor existente en el grupo
                    var profesorSeleccionado = "<?php echo $nombre . ' ' . $apellido1; ?>";
                    $('#listaProfesores').val(profesorSeleccionado);
                }
            });
        }
    </script>
</body>
</html>
