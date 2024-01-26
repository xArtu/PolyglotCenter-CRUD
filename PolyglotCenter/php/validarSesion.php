<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"];
    $contrasena = $_POST["contrasena"];

    $archivo_csv_tipo_usuario = file_get_contents("../data/tipoUsuario.csv");
    $lineas_tipo_usuario = explode(PHP_EOL, $archivo_csv_tipo_usuario);

    $rol_usuario = '';
    $nombre_usuario = '';
    $apellido_usuario = '';

    foreach ($lineas_tipo_usuario as $linea_tipo_usuario) {
        $datos_tipo_usuario = explode(",", $linea_tipo_usuario);
        if ($datos_tipo_usuario[3] == $correo && $datos_tipo_usuario[4] == $contrasena) {
            $rol_usuario = $datos_tipo_usuario[5];
            $nombre_usuario = $datos_tipo_usuario[0];
            $apellido_usuario = $datos_tipo_usuario[1];
            $_SESSION['rol_usuario'] = $rol_usuario;
            $_SESSION['nombre'] = $nombre_usuario;
            $_SESSION['apellido'] = $apellido_usuario;
            $_SESSION['correo'] = $correo; // Almacenar el correo del usuario en la sesión
            break;
        }
    }

    if ($rol_usuario) {
        switch ($rol_usuario) {
            case 'admin':
                header("Location: ../admin/index.php");
                exit();
            case 'alumno':
                header("Location: ../alumno/index.php");
                exit();
            case 'profesor':
                header("Location: ../profesor/index.php");
                exit();
            default:
                header("Location: iniciarSesion.html?error=1");
                exit();
        }
    } else {
        header("Location: iniciarSesion.html?error=1");
        exit();
    }
} else {
    header("Location: ../index.html");
    exit();
}
?>
