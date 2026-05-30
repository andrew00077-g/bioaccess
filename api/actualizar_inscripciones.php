<?php

include "conexion.php";

$data = json_decode(file_get_contents("php://input"), true);

$materia_id = $data['materia_id'];

$estudiantes = $data['estudiantes'];

// ================= LIMPIAR =================

$conn->query("
DELETE FROM inscripciones
WHERE materia_id='$materia_id'
");

// ================= INSERTAR =================

foreach($estudiantes as $est){

    $conn->query("
    INSERT INTO inscripciones(
        estudiante_id,
        materia_id
    )
    VALUES(
        '$est',
        '$materia_id'
    )
    ");
}

echo json_encode([
    "success" => true
]);