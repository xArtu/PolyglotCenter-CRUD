<?php
// Verificar si se han enviado datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST["nombre"];
    $apellido1 = $_POST["apellido1"];
    $apellido2 = $_POST["apellido2"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $fechaNacimiento = $_POST["fechaNacimiento"];
    $contrasena = $_POST["contrasena"];
    $confirmar_contrasena = $_POST["confirmar_contrasena"];

    if ($contrasena != $confirmar_contrasena) {
        die("Las contraseñas no coinciden. Por favor, intenta de nuevo.");
    }

    $ruta_csv_alumno = "../../data/registroAlumno.csv";
    $ruta_csv_tipo_usuario = "../../data/tipoUsuario.csv";

    // Verificar si el correo ya está registrado como alumno
    $contenido_csv_alumno = file_get_contents($ruta_csv_alumno);
    $lineas_alumno = explode(PHP_EOL, $contenido_csv_alumno);
    foreach ($lineas_alumno as $linea) {
        $datos = explode(",", $linea);
        if ($datos[3] == $correo) {
            die("Ya existe un usuario con este correo electrónico. Por favor, utiliza otro.");
        }
    }

    // Registrar al alumno en registroAlumno.csv
    $fecha_actual = new DateTime();
    $fecha_nacimiento = new DateTime($fechaNacimiento);
    $edad = $fecha_actual->diff($fecha_nacimiento)->y;
    if ($edad < 18) {
        die("Debes tener al menos 18 años para registrarte. No se permiten menores de edad.");
    }

    $linea_csv_alumno = "$nombre,$apellido1,$apellido2,$correo,$telefono,$fechaNacimiento,$contrasena,$confirmar_contrasena";
    
    // Agregar verificación de permisos de escritura
    if (!is_writable($ruta_csv_alumno)) {
        die("No se pueden escribir en el archivo $ruta_csv_alumno. Verifica los permisos de escritura.");
    }

    try {
        file_put_contents($ruta_csv_alumno, $linea_csv_alumno . PHP_EOL, FILE_APPEND | LOCK_EX);

        // Registrar el tipo de usuario en tipoUsuario.csv con el rol de alumno
        $linea_csv_tipo_usuario = "$nombre,$apellido1,$apellido2,$correo,$contrasena,alumno";

        // Agregar verificación de permisos de escritura
        if (!is_writable($ruta_csv_tipo_usuario)) {
            die("No se pueden escribir en el archivo $ruta_csv_tipo_usuario. Verifica los permisos de escritura.");
        }

        file_put_contents($ruta_csv_tipo_usuario, $linea_csv_tipo_usuario . PHP_EOL, FILE_APPEND | LOCK_EX);

        header("Location: exito.html");
        exit();
    } catch (Exception $e) {
        die("Error al registrar el usuario: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
    exit();
}
?>
