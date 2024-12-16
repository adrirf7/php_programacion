<?php
function generarTabla($archivoCSV, $tipo)
{
    // Botones para añadir, modificar, y eliminar al principio
    $tabla = "<div class='d-flex justify-content-start mb-3'>";
    $tabla .= "<a href='vistas/añadir/formulario_" . $tipo . ".html' class='btn btn-primary me-2'>Añadir Nuevo " . ucfirst($tipo) . "</a>";
    $tabla .= "<a href='vistas/modificar/formulario_modificar_" . $tipo . ".html' class='btn btn-warning me-2'>Modificar " . ucfirst($tipo) . "</a>";
    $tabla .= "<a href='vistas/eliminar/formulario_eliminar_" . $tipo . ".html' class='btn btn-danger'>Eliminar " . ucfirst($tipo) . "</a>";
    $tabla .= "</div>";

    // Inicar la tabla
    $tabla .= "<table class='table table-striped'>";

    if (($archivo = fopen($archivoCSV, "r")) !== false) {
        $cabeceras = fgetcsv($archivo);
        $tabla .= "<thead><tr>";
        foreach ($cabeceras as $cabecera) {
            $tabla .= "<th>" . htmlspecialchars($cabecera) . "</th>";
        }
        $tabla .= "</tr></thead><tbody>";
        while (($fila = fgetcsv($archivo)) !== false) {
            $tabla .= "<tr>";
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