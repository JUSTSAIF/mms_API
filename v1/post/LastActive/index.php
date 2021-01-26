<?php
// Includes :: JSON retrun 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-type: application/json');
require_once('../../pAPI.php');
include('func.php');


// API
if( isset($_POST['token']) ){
    echo  json_encode(array(
        "msg" => updateLastAct($_POST['token'])
    ));
}

