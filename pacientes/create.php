<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset:UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/Paciente.php';
include_once '../shared/helpers.php';


$database = new Database();
$db=$database->getConnection();

$paciente = new Paciente($db);

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->nombre)) respuestaError('falta el nombre');
if (!isset($data->cedula)) respuestaError('falta la cedula');

$paciente->nombre          = $data->nombre;
$paciente->cedula         = $data->cedula;


$paciente->create();

