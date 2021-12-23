<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset:UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: access");
include_once '../shared/helpers.php';




include_once '../config/database.php';
include_once '../objects/Cita.php';
include_once '../shared/helpers.php';



$database = new Database();
$db = $database->getConnection();

$cita = new Cita($db);


if ( !isset($_GET['id']) || $_GET['id']=="") respuestaError('falta el parametro id');
$cita->id =  $_GET['id'];

$cita->readOne();


$cita_arr = array(
    "id" => $cita->id,
    "fecha" => $cita->fecha,
    "hora" => $cita->hora,
    "paciente_id" => $cita->paciente_id,
    "doctor_id" => $cita->doctor_id,

);

print_r(json_encode($cita_arr));
