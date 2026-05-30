<?php

header("Content-Type: application/json");

include "conexion.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {

    echo json_encode([
        "success" => false,
        "error" => "No llegaron datos"
    ]);

    exit;
}

$id = intval($data["id"]);
$nombre = trim($data["nombre"]);
$apellido = trim($data["apellido"]);

$sql = "
INSERT INTO estudiantes (
    id,
    nombre,
    apellido
)
VALUES (
    '$id',
    '$nombre',
    '$apellido'
)
";

if ($conn->query($sql)) {

    echo json_encode([
        "success" => true
    ]);

} else {

    echo json_encode([
        "success" => false,
        "error" => $conn->error
    ]);
}