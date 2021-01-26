<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-type: application/json');
require_once('../../pAPI.php');


if(isset($_GET['token_check'])){
    if(isset($_GET['r'])){
        echo json_encode(array(
            "token"    => $_GET['token_check'],
            "expTime"  => getTokenDate($_GET['token_check']),
            "msg"      => checkExpireAdmin($_GET['token_check'])
        ));    
    }else{
        echo json_encode(array(
            "token"    => $_GET['token_check'],
            "expTime"  => getTokenDate($_GET['token_check']),
            "msg"      => checkExpire($_GET['token_check'])
        ));    
    }
}