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
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/styles/normalize.css">
    <link rel="stylesheet" href="../src/styles/style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Registrar Grupo</title>
</head>
<body class="bg">
    <main class="contenedor-medio main">
        <h1 class="center" style="color:white">Registrar Grupo de Clase</h1>
        <form action="./php/registrarGrupo.php" method="post" class="formulario">
 
            <label for="curso">Curso:</label>
            <select id="curso" name="curso" required>

            </select>
    
            <label for="nivel">Nivel:</label>
            <select id="nivel" name="nivel" required>

            </select>
    
            <label for="fechaInicio">Fecha de Inicio:</label>
            <input type="date" id="fechaInicio" name="fechaInicio" required>
    
            <label for="fechaFin">Fecha de Fin:</label>
            <input type="date" id="fechaFin" name="fechaFin" required>

            <label for="listaProfesores">Lista de Profesores:</label>
            <select id="listaProfesores" name="listaProfesores" required>
            </select>

            <label for="capacidad">Capacidad:</label>
            <input type="number" id="capacidad" name="capacidad" required placeholder="Capacidad del grupo">

            <button type="submit" class="btn-registro">Registrar Grupo</button>
        </form>
    </main>

    <script>
        // Función para cargar las opciones de Curso y Nivel desde curso.csv
        $(document).ready(function () {
            $.ajax({
                type: "GET",
                url: "../data/curso.csv",
                dataType: "text",
                success: function (data) {
                    var lines = data.split("\n");
                    var cursos = [];
                    var niveles = [];

                    for (var i = 1; i < lines.length; i++) {
                        var cells = lines[i].split(";");
                        cursos.push(cells[0].trim());
                        niveles.push(cells[1].trim());
                    }

                    // Eliminar duplicados y agregar opciones a los select
                    $.each([...new Set(cursos)], function (index, value) {
                        $('#curso').append($('<option>', {
                            value: value,
                            text: value
                        }));
                    });

                    $.each([...new Set(niveles)], function (index, value) {
                        $('#nivel').append($('<option>', {
                            value: value,
                            text: value
                        }));
                    });
                }
            });
        });

        // Función para cargar las opciones de Nombre y Apellido del Profesor
// Función para cargar las opciones de Nombre y Apellido del Profesor
        $(document).ready(function () {
            $.ajax({
                type: "GET",
                url: "../data/registroProfesor.csv",
                dataType: "text",
                success: function (data) {
                    var lines = data.split("\n");
                    var nombresProfesores = [];

                    for (var i = 1; i < lines.length; i++) {
                        var cells = lines[i].split(",");
                        
                        // Verificar si hay suficientes columnas antes de acceder a trim
                        if (cells.length >= 2) {
                            var nombreCompleto = (cells[0].trim() + " " + cells[1].trim()).trim();
                            nombresProfesores.push(nombreCompleto);
                        }
                    }

                    // Eliminar duplicados y agregar opciones al select
                    $.each([...new Set(nombresProfesores)], function (index, value) {
                        $('#listaProfesores').append($('<option>', {
                            value: value,
                            text: value
                        }));
                    });
                }
            });
        });

    </script>
</body>
</html>
