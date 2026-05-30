<?php

include "conexion.php";

$data = json_decode(file_get_contents("php://input"), true);

$id = intval($data["id"]);
$finger_id = intval($data["finger_id"]);

$sql = "
UPDATE estudiantes
SET finger_id='$finger_id'
WHERE id='$id'
";

if($conn->query($sql)){

    echo "OK";

}else{

    echo "ERROR";

}
?>