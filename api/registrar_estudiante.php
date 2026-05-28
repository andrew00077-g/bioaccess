<?php

include "conexion.php";

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$id = intval($data["id"]);
$nombre = $conn->real_escape_string($data["nombre"]);
$apellido = $conn->real_escape_string($data["apellido"]);

// 1. validar si ya existe estudiante
$check = $conn->query("SELECT id FROM estudiantes WHERE id=$id");

if($check->num_rows > 0){
    echo json_encode([
        "success"=>false,
        "error"=>"El ID ya existe"
    ]);
    exit;
}

// 2. insertar estudiante SIN huella aún
$sql = "INSERT INTO estudiantes(id, nombre, apellido, finger_id)
        VALUES($id, '$nombre', '$apellido', NULL)";

if($conn->query($sql)){

    echo json_encode([
        "success"=>true,
        "id"=>$id
    ]);

}else{

    echo json_encode([
        "success"=>false,
        "error"=>$conn->error
    ]);
}