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

// Verificar si se proporciona un ID a través de la URL
if (isset($_GET['id'])) {
    $id_a_eliminar = $_GET['id'];

    // Obtener el contenido actual del archivo
    $archivo_csv_publicaciones = "../../data/publicaciones.csv";
    $contenido_actual = file_get_contents($archivo_csv_publicaciones);

    // Dividir el contenido en líneas
    $lineas = explode(PHP_EOL, $contenido_actual);

    // Crear un nuevo contenido sin la publicación a eliminar
    $nuevo_contenido = "";
    foreach ($lineas as $linea) {
        $datos = explode("+", $linea);
        if ($datos[0] != $id_a_eliminar) {
            $nuevo_contenido .= $linea . PHP_EOL;
        }
    }

    // Escribir el nuevo contenido en el archivo
    file_put_contents($archivo_csv_publicaciones, $nuevo_contenido);

    // Redireccionar al listado de publicaciones
    header("Location: listadoPublicacion.php");
    exit();
} else {
    // Si no se proporciona un ID, redirigir al listado de publicaciones
    header("Location: listadoPublicacion.php");
    exit();
}
?>
