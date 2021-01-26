<?php
// Includes :: JSON retrun 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-type: application/json');
require_once('../../pAPI.php');


// API
if( isset($_GET['pic']) ){
    if(Base64imgValidation($_GET['pic'])){
        echo  json_encode(array(
            "msg" => "Valid Base64 Image"
        ));
    }else{
        echo  json_encode(array(
            "msg" => "Invalid Base64 Image"
        ));
    }
}