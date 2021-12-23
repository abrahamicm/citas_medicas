<?php


//Req headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset:UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//Req includes
include_once '../config/database.php';
include_once '../objects/Cita.php';
include_once '../shared/helpers.php';


$database = new Database();
$db=$database->getConnection();

$cita = new Cita($db);


$data = json_decode(file_get_contents("php://input"));

if (!isset($data->id)) respuestaError('falta el id de la cita');
if (!isset($data->doctor_id)) respuestaError('falta el doctor');
if (!isset($data->aprobado)) respuestaError('falta estado de la aprobacion');

$cita->id            = $data->id;
$cita->doctor_id          = $data->doctor_id;
$cita->aprobado         = $data->aprobado;


$cita->update();