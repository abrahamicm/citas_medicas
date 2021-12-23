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

//Query citas
$stmt = $cita->read();
$num = $stmt->rowCount();

//Check if more than 0 record found
if($num > 0){

    $citas_arr = array();
    $citas_arr["records"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $cita_item=array(
            "id"            =>$id,
            "doctor_id"          =>$doctor_id,
            "fecha"         =>$fecha,
            "hora"         =>$hora,
            "paciente_id"         =>$paciente_id,
        );

        array_push($citas_arr["records"], $cita_item);
    }

    echo json_encode($citas_arr);
}else{
    echo json_encode(
        array("messege" => "No citas found.")
    );
}
