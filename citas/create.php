<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset:UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/Cita.php';
include_once '../shared/helpers.php';


$database = new Database();
$db = $database->getConnection();

$cita = new Cita($db);

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->fecha)) respuestaError('falta la fecha');
if (!isset($data->hora)) respuestaError('falta la hora');
if (!isset($data->paciente_id)) respuestaError('falta el paciente');
if (!isset($data->doctor_id)) respuestaError('falta el doctor');
    


$cita->fecha         = $data->fecha;
$cita->hora         = $data->hora;
$cita->paciente_id         = $data->paciente_id;
$cita->doctor_id         = $data->doctor_id;


$cita->create();