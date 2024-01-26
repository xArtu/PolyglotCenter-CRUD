<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["correo"])) {
    $correo_a_eliminar = $_GET["correo"];

    // Eliminar el registro del archivo registroAlumno.csv
    $ruta_csv_alumno = "../../data/registroAlumno.csv";
    $contenido_csv_alumno = file_get_contents($ruta_csv_alumno);
    $lineas_alumno = explode(PHP_EOL, $contenido_csv_alumno);

    $nuevo_contenido_csv_alumno = "";
    foreach ($lineas_alumno as $linea) {
        $datos = explode(",", $linea);
        if ($datos[3] == $correo_a_eliminar) {
            continue; // No incluir la línea a eliminar
        }
        $nuevo_contenido_csv_alumno .= $linea . PHP_EOL;
    }

    file_put_contents($ruta_csv_alumno, $nuevo_contenido_csv_alumno);

    // Eliminar el registro del archivo tipoUsuario.csv
    $ruta_csv_tipo_usuario = "../../data/tipoUsuario.csv";
    $contenido_csv_tipo_usuario = file_get_contents($ruta_csv_tipo_usuario);
    $lineas_tipo_usuario = explode(PHP_EOL, $contenido_csv_tipo_usuario);

    $nuevo_contenido_csv_tipo_usuario = "";
    foreach ($lineas_tipo_usuario as $linea) {
        $datos = explode(",", $linea);
        if ($datos[3] == $correo_a_eliminar) {
            continue; // No incluir la línea a eliminar
        }
        $nuevo_contenido_csv_tipo_usuario .= $linea . PHP_EOL;
    }

    file_put_contents($ruta_csv_tipo_usuario, $nuevo_contenido_csv_tipo_usuario);

    header("Location: listadoAlumno.php");
    exit();
} else {
    header("Location: listadoAlumno.php");
    exit();
}
?>
