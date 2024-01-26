<?php
// Verificar si se han enviado datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST["nombre"];
    $apellido1 = $_POST["apellido1"];
    $apellido2 = $_POST["apellido2"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $cedula = $_POST["cedula"];
    $contrasena = $_POST["contrasena"];

    $ruta_csv_profesor = "../../data/registroProfesor.csv";
    $ruta_csv_tipo_usuario = "../../data/tipoUsuario.csv";

    // Verificar si el correo ya está registrado como profesor
    $contenido_csv_profesor = file_get_contents($ruta_csv_profesor);
    $lineas_profesor = explode(PHP_EOL, $contenido_csv_profesor);
    foreach ($lineas_profesor as $linea) {
        $datos = explode(",", $linea);
        if ($datos[3] == $correo) {
            die("Ya existe un profesor con este correo electrónico. Por favor, utiliza otro.");
        }
    }

    // Registrar al profesor en registroProfesor.csv
    $linea_csv_profesor = "$nombre,$apellido1,$apellido2,$correo,$telefono,$cedula,$contrasena";
    
    // Agregar verificación de permisos de escritura
    if (!is_writable($ruta_csv_profesor)) {
        die("No se pueden escribir en el archivo $ruta_csv_profesor. Verifica los permisos de escritura.");
    }

    try {
        file_put_contents($ruta_csv_profesor, $linea_csv_profesor . PHP_EOL, FILE_APPEND | LOCK_EX);

        // Registrar el tipo de usuario en tipoUsuario.csv con el rol de profesor
        $linea_csv_tipo_usuario = "$nombre,$apellido1,$apellido2,$correo,$contrasena,profesor";

        // Agregar verificación de permisos de escritura
        if (!is_writable($ruta_csv_tipo_usuario)) {
            die("No se pueden escribir en el archivo $ruta_csv_tipo_usuario. Verifica los permisos de escritura.");
        }

        file_put_contents($ruta_csv_tipo_usuario, $linea_csv_tipo_usuario . PHP_EOL, FILE_APPEND | LOCK_EX);

        header("Location: exito.html");
        exit();
    } catch (Exception $e) {
        die("Error al registrar el profesor: " . $e->getMessage());
    }
} else {
    header("Location: ../index.html");
    exit();
}
?>
