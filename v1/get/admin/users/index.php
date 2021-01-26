<?php
// Includes :: JSON retrun 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-type: application/json');
require_once('../../../pAPI.php');

$users = array();

// API
if( isset($_GET['token']) ){
    $token = $_GET['token'];
    $uid   = GetUID($token);
    if($uid == "token expired"){
        echo  json_encode(array(
            "res" => "token expired"
        )); 
    }elseif($uid == "invalid token"){
        echo  json_encode(array(
            "res" => "invalid token"
        )); 
    }else {
        if(chkUsrExist((int)$uid) & (checkUsrPermissions($token) == "ar" |checkUsrPermissions($token) == "an")){
            $data = $_SESSION['db']->query("SELECT `username`,`id` FROM users")->fetchAll();
            foreach ($data as $row) {
                $users[] = array(
                    'value' => $row['id'],
                    'label' => $row['username']
                );
            }
            echo json_encode($users); 
        }else{
            echo  json_encode(array(
                "res" => "You do not have permissions to view this data !"
            ));
        }
    }
}