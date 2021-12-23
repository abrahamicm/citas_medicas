<?php


//Req headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset:UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//Req includes
include_once '../config/database.php';
include_once '../objects/Paciente.php';
include_once '../shared/helpers.php';

//Db conn and instances
$database = new Database();
$db=$database->getConnection();

$paciente = new Paciente($db);

//Get post data
$data = json_decode(file_get_contents("php://input"));
if (!isset($data->id)) respuestaError('falta el parametro id');
if (!isset($data->nombre)) respuestaError('falta el nombre del paciente');
if (!isset($data->cedula)) respuestaError('falta la cedula del paciente');

//set Id and values of product to be edited
$paciente->id            = $data->id;
$paciente->nombre          = $data->nombre;
$paciente->cedula         = $data->cedula;


//update product
$paciente->update();