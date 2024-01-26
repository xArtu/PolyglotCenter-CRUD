<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $curso = $_POST["curso"];
    $nivel = $_POST["nivel"];
    $fechaInicio = $_POST["fechaInicio"];
    $fechaFin = $_POST["fechaFin"];
    $nombreProfesor = $_POST["listaProfesores"];
    $capacidad = $_POST["capacidad"];
    $grupo_id = $_POST["grupo_id"];

    // Separar el nombre y el apellido del profesor
    list($nombre, $apellido1) = explode(" ", $nombreProfesor, 2);

    // Obtener el contenido del archivo CSV
    $ruta_csv_grupo = "../../data/grupo.csv";
    $contenido_csv_grupo = file_get_contents($ruta_csv_grupo);
    $lineas_grupo = explode(PHP_EOL, $contenido_csv_grupo);

    // Crear un nuevo contenido actualizado
    $nuevo_contenido_csv_grupo = "";
    foreach ($lineas_grupo as $linea) {
        $datos = explode(",", $linea);
        if ($datos[0] == $grupo_id) {
            // Actualizar los datos del grupo
            $linea = "$grupo_id,$curso,$nivel,$fechaInicio,$fechaFin,$nombre,$apellido1,$capacidad";
        }
        $nuevo_contenido_csv_grupo .= $linea . PHP_EOL;
    }

    // Escribir el nuevo contenido en el archivo CSV
    file_put_contents($ruta_csv_grupo, $nuevo_contenido_csv_grupo);

    // Redireccionar a la página de éxito
    header("Location: exito.html");
    exit();
} else {
    // Si se intenta acceder directamente al script sin enviar datos por POST, redireccionar a la lista de grupos
    header("Location: listaGrupos.php");
    exit();
}
?>
