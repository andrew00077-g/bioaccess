<?php
include "conexion.php";

$conn->query("
UPDATE sistema
SET modo = 0,
    nuevo_id = 0
");

echo json_encode([
    "success" => true
]);
