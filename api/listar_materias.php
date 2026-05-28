<?php

header("Content-Type: application/json");

require_once "conexion.php";

$resultado = $conn->query(
    "SELECT * FROM materias ORDER BY id DESC"
);

$materias = [];

while($fila = $resultado->fetch_assoc()){

    $stmt = $conn->prepare(
        "SELECT COUNT(*) as total
         FROM inscripciones
         WHERE materia_id=?"
    );

    $stmt->bind_param(
        "i",
        $fila["id"]
    );

    $stmt->execute();

    $r = $stmt->get_result()->fetch_assoc();

    $fila["total_estudiantes"] = $r["total"];

    $materias[] = $fila;
}

echo json_encode($materias);

?>