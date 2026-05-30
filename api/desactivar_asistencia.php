<?php

include "conexion.php";

$sql = "
UPDATE materias
SET activa='0'
";

$conn->query($sql);

echo "OK";