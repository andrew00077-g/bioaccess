<?php

header("Content-Type: application/json");

require_once "conexion.php";

$data = json_decode(
    file_get_contents("php://input"),
    true
);

$nombre = $data["nombre"];
$hora_inicio = $data["hora_inicio"];
$hora_fin = $data["hora_fin"];
$dias = implode(", ", $data["dias"]);
$inscritos = $data["inscritos"];

$stmt = $conn->prepare(
    "INSERT INTO materias(nombre,hora_inicio,hora_fin,dias)
     VALUES(?,?,?,?)"
);

$stmt->bind_param(
    "ssss",
    $nombre,
    $hora_inicio,
    $hora_fin,
    $dias
);

if(!$stmt->execute()){

    echo json_encode([
        "success"=>false,
        "error"=>"La materia ya existe"
    ]);

    exit;
}

$materia_id = $conn->insert_id;

foreach($inscritos as $estudiante_id){

    $stmt2 = $conn->prepare(
        "INSERT INTO inscripciones(estudiante_id,materia_id)
         VALUES(?,?)"
    );

    $stmt2->bind_param(
        "ii",
        $estudiante_id,
        $materia_id
    );

    $stmt2->execute();
}

echo json_encode([
    "success"=>true
]);

?>