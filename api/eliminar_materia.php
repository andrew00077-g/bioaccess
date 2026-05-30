<?php

header("Content-Type: application/json");

require_once "conexion.php";

$id = $_GET["id"];

$stmt1 = $conn->prepare(
    "DELETE FROM inscripciones
     WHERE materia_id=?"
);

$stmt1->bind_param(
    "i",
    $id
);

$stmt1->execute();

$stmt2 = $conn->prepare(
    "DELETE FROM materias
     WHERE id=?"
);

$stmt2->bind_param(
    "i",
    $id
);

$ok = $stmt2->execute();

echo json_encode([
    "success" => $ok
]);
