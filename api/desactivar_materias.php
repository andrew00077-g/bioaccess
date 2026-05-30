<?php

include "conexion.php";

$sql = "UPDATE materias SET activa='0'";

if($conn->query($sql)){
    echo "OK";
}else{
    echo "ERROR";
}
?>