<?php
// Includes :: JSON retrun 
require_once('../../../../pAPI.php');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-type: application/json');

$cards = array();

// API
if (isset($_POST['token']) & isset($_POST['cid'])) {
    echo  json_encode(array(
        "res" => HideCard($_POST['token'], $_POST['cid'])
    ));
}


// Function :: 
function HideCard($token, $cid) {
    // Start Function :: 
    $token = $_POST['token'];
    $uid   = GetUID($token);
    if ($uid == "token expired") {
        return "token expired";
    } elseif ($uid == "invalid token") {
        return "invalid token";
    } else {
        if (chkUsrExist((int)$uid) & (checkUsrPermissions($token) == "ar")) {
            if(in_array((int)$cid,[1,2,3])){
                try {
                    $C_query = $_SESSION['db']->prepare("UPDATE `buy-section` SET hide=1 WHERE id=:id")->execute(['id'=>$cid]);
                    if($C_query){
                        return "Card " . $cid . " Hide Successfully";
                    }else{
                        return "Card Hide Failed";
                    }
                } catch (\Throwable $th) {
                    return "Card Hide Failed !!";
                }    
            }else{
                return "Err :: check your Data !!";
            }
        } else {
            return "Don't Have permissions !";
        }
    }
}