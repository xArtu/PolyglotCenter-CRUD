<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST["nombre"];
    $apellido1 = $_POST["apellido1"];
    $apellido2 = $_POST["apellido2"];
    $telefono = $_POST["telefono"];
    $cedula = $_POST["cedula"];
    $correo_original = $_POST["correo_original"];
    $contrasena = $_POST["contrasena"];

    // Obtener el contenido del archivo CSV
    $ruta_csv_profesor = "../../data/registroProfesor.csv";
    $contenido_csv_profesor = file_get_contents($ruta_csv_profesor);
    $lineas_profesor = explode(PHP_EOL, $contenido_csv_profesor);

    // Crear un nuevo contenido actualizado
    $nuevo_contenido_csv_profesor = "";
    foreach ($lineas_profesor as $linea) {
        $datos = explode(",", $linea);
        if ($datos[3] == $correo_original) {
            // Actualizar los datos del profesor
            $linea = "$nombre,$apellido1,$apellido2,$correo_original,$telefono,$cedula,$contrasena";
        }
        $nuevo_contenido_csv_profesor .= $linea . PHP_EOL;
    }

    // Escribir el nuevo contenido en el archivo CSV
    file_put_contents($ruta_csv_profesor, $nuevo_contenido_csv_profesor);

    // Actualizar también en tipoUsuario.csv
    $ruta_csv_tipo_usuario = "../../data/tipoUsuario.csv";
    $contenido_csv_tipo_usuario = file_get_contents($ruta_csv_tipo_usuario);
    $lineas_tipo_usuario = explode(PHP_EOL, $contenido_csv_tipo_usuario);

    // Crear un nuevo contenido actualizado
    $nuevo_contenido_csv_tipo_usuario = "";
    foreach ($lineas_tipo_usuario as $linea) {
        $datos = explode(",", $linea);
        if ($datos[3] == $correo_original) {
            // Actualizar los datos del tipo de usuario
            $linea = "$nombre,$apellido1,$apellido2,$correo_original,$contrasena,profesor";
        }
        $nuevo_contenido_csv_tipo_usuario .= $linea . PHP_EOL;
    }

    // Escribir el nuevo contenido en el archivo CSV
    file_put_contents($ruta_csv_tipo_usuario, $nuevo_contenido_csv_tipo_usuario);

    header("Location: exito.html");
    exit();
} else {
    // Si se intenta acceder directamente al script sin enviar datos por POST, redireccionar a la lista de profesores
    header("Location: listaProfesores.php");
    exit();
}
?>
