<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id_a_eliminar = $_GET["id"];

    // Eliminar del archivo grupo.csv
    $ruta_csv_grupo = "../../data/grupo.csv";
    $contenido_csv_grupo = file_get_contents($ruta_csv_grupo);
    $lineas_grupo = explode(PHP_EOL, $contenido_csv_grupo);

    $nuevo_contenido_csv_grupo = "";
    foreach ($lineas_grupo as $linea) {
        $datos = explode(",", $linea);
        if ($datos[0] !== $id_a_eliminar) {
            $nuevo_contenido_csv_grupo .= $linea . PHP_EOL;
        }
    }

    file_put_contents($ruta_csv_grupo, $nuevo_contenido_csv_grupo);

    header("Location: listadoGrupo.php");
    exit();
} else {
    // Si no se proporciona un ID, redirigir a la lista de grupos
    header("Location: listadoGrupo.php");
    exit();
}
?>
