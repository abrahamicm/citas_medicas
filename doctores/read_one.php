<?php

//Req headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset:UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: access");
include_once '../shared/helpers.php';

//Include db and object

include_once '../config/database.php';
include_once '../objects/Doctor.php';

//New instances

$database = new Database();
$db = $database->getConnection();

$doctor = new Doctor($db);

//Set ID of product to be edited
if ( !isset($_GET['id']) || $_GET['id']=="") respuestaError('falta el parametro id');
$doctor->id = isset($_GET['id']) ? $_GET['id']: die ("el id no esta definido");

//Read details of edited product
$doctor->readOne();

//Create array
$doctor_arr = array(
    "id" => $doctor->id,
    "nombre" => $doctor->nombre,
    "cedula" => $doctor->cedula,

);

echo json_encode($doctor_arr);
