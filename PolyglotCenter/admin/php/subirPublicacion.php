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

// Verificar si se han enviado datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $autor = $_POST["autor"];
    $contenido = $_POST["contenido"];
    $fechaPublicacion = $_POST["fechaPublicacion"];

    $ruta_csv_publicaciones = "../../data/publicaciones.csv";

    // Verificar si se proporcionaron todos los datos necesarios
    if (empty($autor) || empty($contenido) || empty($fechaPublicacion)) {
        die("Por favor, completa todos los campos del formulario.");
    }

    // Validar si el archivo de publicaciones existe y es escribible
    if (!file_exists($ruta_csv_publicaciones) || !is_writable($ruta_csv_publicaciones)) {
        die("No se puede acceder o escribir en el archivo de publicaciones. Verifica los permisos.");
    }

    try {
        // Obtener el contenido actual del archivo
        $contenido_actual = file_get_contents($ruta_csv_publicaciones);

        // Dividir el contenido en líneas
        $lineas = explode(PHP_EOL, $contenido_actual);

        // Obtener el último ID y calcular el siguiente
        $ultimo_id = 0;
        if (count($lineas) > 1) {
            // Obtener el último ID almacenado
            $ultima_linea = $lineas[count($lineas) - 2];
            $datos_ultima_linea = explode("+", $ultima_linea);
            $ultimo_id = intval($datos_ultima_linea[0]);
        }

        // Calcular el nuevo ID
        $nuevo_id = $ultimo_id + 1;

        // Crear la línea CSV con el formato especificado (ID + autor + contenido + fechaPublicacion)
        $linea_csv = $nuevo_id . '+' . $autor . '+' . $contenido . '+' . $fechaPublicacion;

        // Insertar la nueva línea después del segundo renglón (índice 1)
        array_splice($lineas, 1, 0, $linea_csv);

        // Unir las líneas de nuevo en una cadena y escribir al archivo
        file_put_contents($ruta_csv_publicaciones, implode(PHP_EOL, $lineas));

        header("Location: exito.html");
        exit();
    } catch (Exception $e) {
        die("Error al crear la publicación: " . $e->getMessage());
    }
} else {
    header("Location: index.php");
    exit();
}
?>
