<?php

include "conexion.php";

$materia_id = $_GET['materia_id'];

$fecha = date("Y-m-d");

$sql = "
SELECT 
    e.id,
    e.nombre,
    e.apellido,

    a.hora,
    
    COALESCE(a.estado, 'NO PRESENTE') as estado

FROM inscripciones i

INNER JOIN estudiantes e
ON e.id = i.estudiante_id

LEFT JOIN asistencia a
ON a.estudiante_id = e.id
AND a.materia_id = i.materia_id
AND a.fecha = '$fecha'

WHERE i.materia_id = '$materia_id'

ORDER BY e.nombre ASC
";

$res = $conn->query($sql);

$data = [];

while ($row = $res->fetch_assoc()) {

    $data[] = $row;
}

echo json_encode($data);
