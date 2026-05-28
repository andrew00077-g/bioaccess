<?php

include "conexion.php";

date_default_timezone_set("America/La_Paz");

if(!isset($_GET['huella_id'])){
    exit;
}

$huella_id = $_GET['huella_id'];

$fecha = date("Y-m-d");
$horaActual = date("H:i:s");


$sqlHuella = "
SELECT id
FROM estudiantes
WHERE finger_id='$huella_id'
";

$resHuella = $conn->query($sqlHuella);

if($resHuella->num_rows == 0){

    echo "HUELLA_NO_REGISTRADA";
    exit;

}

$dataHuella = $resHuella->fetch_assoc();

$estudiante_id = $dataHuella['id'];



// ================= BUSCAR MATERIA ACTIVA =================

$sqlMateria = "
SELECT *
FROM materias
WHERE activa='1'
LIMIT 1
";

$resMateria = $conn->query($sqlMateria);

if($resMateria->num_rows == 0){

    echo "SIN_CLASE";
    exit;

}

$materia = $resMateria->fetch_assoc();

$materia_id = $materia['id'];



// ================= VERIFICAR INSCRIPCION =================

$sqlIns = "
SELECT *
FROM inscripciones
WHERE estudiante_id='$estudiante_id'
AND materia_id='$materia_id'
";

$resIns = $conn->query($sqlIns);

if($resIns->num_rows == 0){

    echo "NO_INSCRITO";
    exit;

}



// ================= VERIFICAR SI YA MARCO =================

$sqlDup = "
SELECT *
FROM asistencia
WHERE estudiante_id='$estudiante_id'
AND materia_id='$materia_id'
AND fecha='$fecha'
";

$resDup = $conn->query($sqlDup);

if($resDup->num_rows > 0){

    echo "YA_MARCO";
    exit;

}



// ================= CALCULAR ESTADO =================

$horaInicio = strtotime($materia['hora_inicio']);

$horaActualTime = strtotime($horaActual);

$tolerancia = $horaInicio + (15 * 60);

$estado = "PRESENTE";

if($horaActualTime > $tolerancia){

    $estado = "RETRASO";

}



// ================= GUARDAR ASISTENCIA =================

$sqlGuardar = "
INSERT INTO asistencia(
    estudiante_id,
    materia_id,
    fecha,
    hora,
    estado
)
VALUES(
    '$estudiante_id',
    '$materia_id',
    '$fecha',
    '$horaActual',
    '$estado'
)
";

if($conn->query($sqlGuardar)){

    echo $estado;

}else{

    echo "ERROR_DB";

}

?>