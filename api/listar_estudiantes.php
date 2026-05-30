<?php

include "conexion.php";

$result = $conn->query(
    "SELECT * FROM estudiantes ORDER BY id"
);

$datos = [];

while ($row = $result->fetch_assoc()) {
    $datos[] = $row;
}

echo json_encode($datos);
