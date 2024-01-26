<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $curso = $_POST["curso"];
    $nivel = $_POST["nivel"];
    $fechaInicio = $_POST["fechaInicio"];
    $fechaFin = $_POST["fechaFin"];
    $nombreCompletoProfesor = $_POST["listaProfesores"];
    $capacidad = $_POST["capacidad"];
    // Separar el nombre y el apellido del profesor
    list($nombreProfesor, $apellido1) = explode(" ", $nombreCompletoProfesor, 2);

    // Obtener el último Id en el archivo grupo.csv
    $archivo_csv_grupo = "../../data/grupo.csv";
    $contenido_csv_grupo = file_get_contents($archivo_csv_grupo);
    $lineas_grupo = explode(PHP_EOL, $contenido_csv_grupo);

    $ultimoId = 0;

    foreach ($lineas_grupo as $linea) {
        $datos = explode(",", $linea);
        $id = intval($datos[0]);
        if ($id > $ultimoId) {
            $ultimoId = $id;
        }
    }

    // Incrementar el Id para el nuevo grupo
    $nuevoId = $ultimoId + 1;

    // Crear una cadena CSV con los datos del grupo
    $linea_csv = "$nuevoId,$curso,$nivel,$fechaInicio,$fechaFin,$nombreProfesor,$apellido1,$capacidad";

    // Abre el archivo CSV en modo de escritura y agrega la línea
    file_put_contents($archivo_csv_grupo, $linea_csv . PHP_EOL, FILE_APPEND);

    // Redireccionar o mostrar un mensaje de éxito
    header("Location: exito.html");
    exit();
} else {
    // Si se intenta acceder directamente al script sin enviar datos por POST, redireccionar a la página principal
    header("Location: registrarCurso.html");
    exit();
}
?>
