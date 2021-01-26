<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-type: application/json');
require_once('../../pAPI.php');


if(isset($_POST['username']) & isset($_POST['password'])){
    echo json_encode(array(
        "msg"      => checkLogin($_POST['username'], $_POST['password'])
    ));
}