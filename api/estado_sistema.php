<?php
header("Content-Type: application/json");

include "conexion.php";

$result = $conn->query("SELECT * FROM sistema LIMIT 1");

if($result && $result->num_rows > 0){
    $row = $result->fetch_assoc();

    echo json_encode([
        "modo" => intval($row["modo"]),
        "nuevo_id" => intval($row["nuevo_id"])
    ]);

}else{

    echo json_encode([
        "modo" => 0,
        "nuevo_id" => 0
    ]);
}