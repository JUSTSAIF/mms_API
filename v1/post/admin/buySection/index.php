<?php
// Includes :: JSON retrun 
require_once('../../../pAPI.php');
require_once('func.php');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-type: application/json');

$cards = array();

// API
if(
    isset($_POST['token']) &
    isset($_POST['cid']) &
    isset($_POST['head']) &
    isset($_POST['price']) &
    isset($_POST['SubscriptionTime']) &
    isset($_POST['currencyType']) &
    isset($_POST['productInfo_1']) &
    isset($_POST['productInfo_2']) &
    isset($_POST['productInfo_3']) &
    isset($_POST['productInfo_4']) &
    isset($_POST['productInfo_5']) &
    isset($_POST['productInfo_6']) &
    isset($_POST['buttonText']) &
    isset($_POST['redirect_link'])
){
    echo  json_encode(array(
        "res" => ChangeCard(
            $_POST['token'],
            $_POST['cid'],
            $_POST['head'],
            $_POST['price'],
            $_POST['SubscriptionTime'],
            $_POST['currencyType'],
            $_POST['productInfo_1'],
            $_POST['productInfo_2'],
            $_POST['productInfo_3'],
            $_POST['productInfo_4'],
            $_POST['productInfo_5'],
            $_POST['productInfo_6'],
            $_POST['buttonText'],
            $_POST['redirect_link']
        )
    )); 
}