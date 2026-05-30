<?php

header("Content-Type: application/json");

include "conexion.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {

    echo json_encode([
        "success" => false,
        "error" => "Sin datos"
    ]);

    exit;
}

$id = intval($data["id"]);

$sql = "
UPDATE sistema
SET modo = 1,
    nuevo_id = $id
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