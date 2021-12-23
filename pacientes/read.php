<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//Include db and object

include_once '../config/database.php';
include_once '../objects/Paciente.php';
include_once '../shared/helpers.php';

//New instances

$database = new Database();
$db = $database->getConnection();

$paciente = new Paciente($db);

//Query pacientes
$stmt = $paciente->read();
$num = $stmt->rowCount();

//Check if more than 0 record found
if($num > 0){

    $pacientes_arr = array();
    $pacientes_arr["records"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $paciente_item = array(
            "id"            =>  $id,
            "nombre"          =>  $nombre,
            "cedula"         =>  $cedula,

        );

        array_push($pacientes_arr["records"], $paciente_item);
    }

    echo json_encode($pacientes_arr);
}else{
    echo json_encode(
        array("messege" => "No pacientes found.")
    );
}
