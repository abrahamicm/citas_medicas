<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset:UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once '../config/database.php';
include_once '../objects/Doctor.php';
include_once '../shared/helpers.php';


$database = new Database();
$db=$database->getConnection();

$doctor = new Doctor($db);


$data = json_decode(file_get_contents("php://input"));
if (!isset($data->id)) respuestaError('falta el id');


$doctor->id = $data->id;


$doctor->delete();