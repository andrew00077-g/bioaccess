<?php
include "conexion.php";

$data = json_decode(file_get_contents("php://input"), true);

$id = intval($data["id"]);

$stmt = $conn->prepare("
UPDATE sistema
SET modo = 1,
    nuevo_id = ?
");

$stmt->bind_param("i", $id);

if($stmt->execute()){
    echo json_encode([
        "success" => true,
        "modo" => 1,
        "nuevo_id" => $id
    ]);
}else{
    echo json_encode([
        "success" => false,
        "error" => $conn->error
    ]);
}