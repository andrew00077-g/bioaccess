<?php

include "conexion.php";

$id = $_GET['id'];

$conn->query("UPDATE materias SET activa='0'");

$conn->query("
UPDATE materias
SET activa='1'
WHERE id='$id'
");

echo "OK";
?>