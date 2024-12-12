<?php
function generarTabla($archivoCSV)
{
    $tabla = "<table class='table table-striped'>";
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