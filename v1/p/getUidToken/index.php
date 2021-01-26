<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-type: application/json');
require_once('../../pAPI.php');

//  API
if(isset($_GET['token_uid'])){
    $chk  = checkExpire($_GET['token_uid']);
    if($chk == "token active"){
        print_r(json_encode(array(
            "token"     => $_GET['token_uid'],
            "uid"       => (int)GetUID($_GET['token_uid']),
            "msg"    => "token active"
        )));
    }elseif($chk == "token expired"){
        print_r(json_encode(array(
            "token"     => $_GET['token_uid'],
            "msg"    => "token expired"
        )));
    }elseif($chk == "invalid token"){
        print_r(json_encode(array(
            "token"     => $_GET['token_uid'],
            "msg"    => "invalid token"
        )));
    }else {
        print_r(json_encode(array(
            "msg"    => "err"
        )));
    }
}