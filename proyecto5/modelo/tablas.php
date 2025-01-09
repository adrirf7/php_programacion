<?php
function generarTabla($archivoCSV, $tipo)
{
    // Crear la sección de botones para las acciones de Añadir, Modificar y Eliminar
    $tabla = "<div class='d-flex justify-content-start mb-3'; style='margin-left: 20px'>";
    $tabla .= "<a href='vistas/formulario_" . $tipo . ".html' class='btn btn-primary me-2'>Añadir Nuevo " . ucfirst($tipo) . "</a>";
    $tabla .= "<a href='vistas/formulario_modificar_" . $tipo . ".html' class='btn btn-warning me-2'>Modificar " . ucfirst($tipo) . "</a>";
    $tabla .= "<a href='vistas/formulario_eliminar_" . $tipo . ".html' class='btn btn-danger'>Eliminar " . ucfirst($tipo) . "</a>";
    $tabla .= "</div>";

    // Iniciar la tabla HTML
    $tabla .= "<table class='table table-striped'>";

    // Intentar abrir el archivo CSV
    if (($archivo = fopen($archivoCSV, "r")) !== false) {
        $cabeceras = fgetcsv($archivo);

        // Crear la cabecera de la tabla con las columnas correspondientes
        $tabla .= "<thead><tr>";
        foreach ($cabeceras as $cabecera) {
            $tabla .= "<th>" . htmlspecialchars($cabecera) . "</th>";
        }
        $tabla .= "</tr></thead><tbody>";

        // Leer las filas restantes del archivo CSV
        while (($fila = fgetcsv($archivo)) !== false) {
            $tabla .= "<tr>"; // Iniciar una nueva fila en la tabla
            foreach ($fila as $celda) {
                $tabla .= "<td>" . htmlspecialchars($celda) . "</td>";
            }
            $tabla .= "</tr>";
        }

        fclose($archivo);
    }

    $tabla .= "</tbody></table>";

    return $tabla;
}
