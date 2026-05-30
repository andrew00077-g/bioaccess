<?php

include "conexion.php";

$materia_id = $_GET['materia_id'];

$sql = "
SELECT estudiante_id
FROM inscripciones
WHERE materia_id='$materia_id'
";

$res = $conn->query($sql);

$data = [];

while($row = $res->fetch_assoc()){

    $data[] = $row;
}

echo json_encode($data);