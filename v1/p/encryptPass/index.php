<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-type: application/json');
require_once('../../pAPI.php');


//  Web API
if(isset($_GET['pass'])){
    $pass = $_GET['pass'];
    print_r(json_encode(array(
        "original_pass"    => $pass,
        "encrypted_pass"   => enc_pass($pass)
    )));
}