<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//Include db and object

include_once '../config/database.php';
include_once '../objects/Doctor.php';
include_once '../shared/helpers.php';

//New instances

$database = new Database();
$db = $database->getConnection();

$doctor = new Doctor($db);

//Query doctors
$stmt = $doctor->read();
$num = $stmt->rowCount();

//Check if more than 0 record found
if($num > 0){

    $doctores_arr = array();
    $doctores_arr["records"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $doctor_item = array(
            "id"            =>  $id,
            "nombre"          =>  $nombre,
            "cedula"         =>  $cedula,

        );

        array_push($doctores_arr["records"], $doctor_item);
    }

    echo json_encode($doctores_arr);
}else{
    echo json_encode(
        array("messege" => "No doctors found.")
    );
}
