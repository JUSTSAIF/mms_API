<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-type: application/json');
require_once('../../pAPI.php');

// API
if(
    isset($_POST['role'])&&
    isset($_POST['sToken'])&&
    isset($_POST['name'])&&
    isset($_POST['username'])&&
    isset($_POST['password'])&&
    isset($_POST['expire-date'])
){
    $sToken = $_POST['sToken'];
    $role   = $_POST['role'];
    $uid    = GetUID($sToken);
    if($uid == "token expired"){
        echo json_encode(array("msg"   => "token expired"));
    }elseif($uid == "invalid token"){
        echo json_encode(array("msg"   => "invalid token"));
    }else{
        if(chkUsrExist((int)$uid)){
            if(checkUsrPermissions($sToken) == "ar"){
                if(in_array($role, $roles)){
                    echo json_encode(array("msg" => CreateUserAPI($role,$_POST['name'],$_POST['username'],$_POST['password'],$_POST['expire-date'])));
                }else{
                    echo json_encode(array("msg" => "role name was not recognized !"));
                }
            }elseif(checkUsrPermissions($sToken) == "an"){
                if(in_array($role, $roles)){
                    if($role == "ar"){
                        echo json_encode(array("msg"   => "you don't have permissions to Create [ Administrator ] User !"));
                    }else{
                        echo json_encode(array("msg" => CreateUserAPI($role,$_POST['name'],$_POST['username'],$_POST['password'],$_POST['expire-date'])));    
                    }
                }else{
                    echo json_encode(array("msg"   => "role name was not recognized !"));
                }
            }else{
                echo json_encode(array("msg"   => "you don't have permissions to Create Users !"));
            }
        }else{
            echo json_encode(array("msg"   => "Admin Account Not Exist Maybe Deleted !"));
        }
    }
}