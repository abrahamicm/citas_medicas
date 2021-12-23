<?php

function respuestaError($x){
    echo json_encode(["error"=>$x]);
    die();
}