<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset:UTF-8");

include_once '../config/database.php';
include_once '../objects/Cita.php';
include_once '../shared/helpers.php';

$database = new Database();
$db=$database->getConnection();

$cita = new Cita($db);

$keywords = isset($_GET["s"]) ? $_GET["s"] : "";

$stmt=$cita->search($keywords);
$num=$stmt->rowCount();

if($num>0){
    $citas_arr = array();
    $citas_arr["records"] = array();

    while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
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
        array("message" => "Cita no encontrado")
    );
}
