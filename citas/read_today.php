<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//Include db and object

include_once '../config/database.php';
include_once '../objects/Cita.php';
include_once '../shared/helpers.php';

//New instances

$database = new Database();
$db = $database->getConnection();

$cita = new Cita($db);

if ( !isset($_GET['doctor_id']) || $_GET['doctor_id']== "" ) respuestaError('falta el id del doctor');
$doctor_id = $_GET['doctor_id'];

$today =date("Y-m-d");

$stmt = $cita->readToday($doctor_id,$today);
$num = $stmt->rowCount();

//Check if more than 0 record found
if($num > 0){

    $citas_arr = array();
    $citas_arr["records"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $cita_item=array(
            "cita_id"            =>$cita_id,
            "doctor_id"          =>$doctor_id,
            "hora"         =>$hora,
            "fecha"         =>$fecha,
            "paciente_id"         =>$paciente_id,
            "aprobado"         =>$aprobado,
        );

        array_push($citas_arr["records"], $cita_item);
    }

    echo json_encode($citas_arr);
}else{
    echo json_encode(
        array("messege" => "No citas found.")
    );
}
