<?php

include "conexion.php";

date_default_timezone_set("America/La_Paz");

if (!isset($_GET['huella_id'])) {
    exit;
}

$huella_id = $_GET['huella_id'];

$fecha = date("Y-m-d");
$horaActual = date("H:i:s");

// ================= BUSCAR ESTUDIANTE =================

$sqlHuella = "
SELECT *
FROM estudiantes
WHERE finger_id='$huella_id'
";

$resHuella = $conn->query($sqlHuella);

if ($resHuella->num_rows == 0) {

    echo "HUELLA_NO_REGISTRADA|DESCONOCIDO";
    exit;
}

$estudiante = $resHuella->fetch_assoc();

$estudiante_id = $estudiante['id'];

$nombreCompleto =
    $estudiante['nombre'] . " " . $estudiante['apellido'];


// ================= BUSCAR MATERIA ACTIVA =================

$sqlMateria = "
SELECT *
FROM materias
WHERE activa='1'
LIMIT 1
";

$resMateria = $conn->query($sqlMateria);


// =========================================================
// NO HAY MATERIA ACTIVA
// =========================================================

if ($resMateria->num_rows == 0) {

    echo "REGISTRADO|" . $nombreCompleto;
    exit;
}


// ================= MATERIA ACTIVA =================

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

if ($resIns->num_rows == 0) {

    echo "NO_INSCRITO|" . $nombreCompleto;
    exit;
}


// ================= VERIFICAR YA MARCO =================

$sqlDup = "
SELECT *
FROM asistencia
WHERE estudiante_id='$estudiante_id'
AND materia_id='$materia_id'
AND fecha='$fecha'
";

$resDup = $conn->query($sqlDup);

if ($resDup->num_rows > 0) {

    echo "YA_MARCO|" . $nombreCompleto;
    exit;
}


// ================= CALCULAR ESTADO =================

$horaInicio = strtotime($materia['hora_inicio']);

$horaActualTime = strtotime($horaActual);

$tolerancia = $horaInicio + (15 * 60);

$estado = "PRESENTE";

if ($horaActualTime > $tolerancia) {

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

if ($conn->query($sqlGuardar)) {

    echo $estado . "|" . $nombreCompleto;

} else {

    echo "ERROR_DB|" . $nombreCompleto;
}