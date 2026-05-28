<?php

include "conexion.php";

$id = intval($_GET["id"]);

$result = $conn->query(
"SELECT * FROM estudiantes WHERE id=$id LIMIT 1"
);

if($result->num_rows > 0){

    echo json_encode(
        $result->fetch_assoc()
    );

}else{

    echo json_encode([
        "error"=>"No encontrado"
    ]);

}