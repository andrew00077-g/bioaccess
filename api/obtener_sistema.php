<?php
header("Content-Type: application/json");
include "conexion.php";

$result = $conn->query("SELECT modo, nuevo_id FROM sistema LIMIT 1");

if ($row = $result->fetch_assoc()) {

    echo json_encode([
        "modo" => (int)$row["modo"],
        "nuevo_id" => (int)$row["nuevo_id"]
    ]);
} else {

    echo json_encode([
        "modo" => 0,
        "nuevo_id" => 0
    ]);
}
