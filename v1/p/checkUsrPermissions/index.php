<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-type: application/json');
require_once('../../pAPI.php');

if(isset($_GET['token_check'])){
    echo json_encode(array(
        "token"     => $_GET['token_check'],
        "msg"    => checkUsrPermissions($_GET['token_check'])
    ));
}