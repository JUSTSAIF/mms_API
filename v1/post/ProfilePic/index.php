<?php
// Includes :: JSON retrun 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-type: application/json');
require_once('../../pAPI.php');
include('func.php');

// API
if(isset($_POST['token']) & isset($_POST['base64'])){
    echo json_encode(array(
        "msg"   => setProfilePhoto( $_POST['token'], $_POST['base64'] )
    ));
}
