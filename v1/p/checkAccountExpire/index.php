<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-type: application/json');
require_once('../../pAPI.php');

if(isset($_POST['token'])){
    echo json_encode(array(
        "msg"  => chkAccExp($_POST['token'])
    ));
}