<?php

//Req headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset:UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: access");

//Include db and object

include_once '../config/database.php';
include_once '../objects/Paciente.php';
include_once '../shared/helpers.php';

//New instances

$database = new Database();
$db = $database->getConnection();

$paciente = new Paciente($db);


if ( !isset($_GET['id']) || $_GET['id']=="") respuestaError('falta el parametro id');
$paciente->id = isset($_GET['id']) ? $_GET['id']: die ("el id no esta definido");

//Read details of edited product
$paciente->readOne();

//Create array
$paciente_arr = array(
    "id" => $paciente->id,
    "nombre" => $paciente->nombre,
    "cedula" => $paciente->cedula,

);

echo json_encode($paciente_arr);
