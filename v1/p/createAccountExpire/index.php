<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-type: application/json');
require_once('../../pAPI.php');


if(isset($_GET['exp'])){
    echo json_encode(array(
        "expire_time"     => GetExp($_GET['exp'])
        // "msg"             => checkUsrPermissions($_GET['token_check'])
    ));
}