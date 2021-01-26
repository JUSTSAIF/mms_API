<?php
// Includes :: JSON retrun 
require_once('../../../pAPI.php');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-type: application/json');
// API
if( isset($_POST['token']) & isset($_POST['sp']) & isset($_POST['pc']) ){
    echo  json_encode(array(
        "res" => ChangeCountSec($_POST['token'],$_POST['sp'],$_POST['pc'])
    )); 
}



function ChangeCountSec($token,$sp,$pc) {
    // Start Function :: 
    $token = $_POST['token'];
    $uid   = GetUID($token);
    if ($uid == "token expired") {
        return "token expired";
    } elseif ($uid == "invalid token") {
        return "invalid token";
    } else {
        if (chkUsrExist((int)$uid) & (checkUsrPermissions($token) == "ar")) {
            try {
                $query = $_SESSION['db']->prepare("UPDATE `site_info` SET SoldProgram=:sp, ProgramsCreated=:pc WHERE mayid=0")->execute(['sp'=>(int)$sp,'pc'=>(int)$pc]);
                if($query){
                    return "Changed Successfully";
                }else{
                    return "Change Failed";
                }
            } catch (\Throwable $th) {
                return "Change Failed !!!";
            }
        } else {
            return "Don't Have permissions !";
        }
    }
}
