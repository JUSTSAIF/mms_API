<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-type: application/json');
require_once('../../pAPI.php');

// API
if(isset($_POST['uid']) & isset($_POST['token'])){
    $token = $_POST['token'];
    $uid   = $_POST['uid'];
    $aid   = GetUID($token);
    if($aid == "token expired"){
        echo  json_encode(array(
            "res" => "token expired"
        )); 
    }elseif($aid  == "invalid token"){
        echo  json_encode(array(
            "res" => "invalid token"
        )); 
    }else {
        echo json_encode(array(
            "res" => userDelete($uid,$token)
        ));
    }
}