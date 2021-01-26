<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-type: application/json');
require_once('../../pAPI.php');

// API
if(isset($_GET['email'])){
    $email = $_GET['email'];
    if(chkEmailValid($email)) { 
        echo json_encode(array("isValid"=>true));
    }else{
        echo json_encode(array("isValid"=>false));
    }
}