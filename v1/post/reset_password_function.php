<?php

function changePass($token, $oldPass, $newPass){
    $uid = GetUID($token);
    if($uid == "token expired"){
        return "token expired";
    }elseif($uid == "invalid token"){
        return "invalid token";
    }else{
        if(chkUsrExist((int)$uid)){
            $oldPassDB = $_SESSION['db']->query("SELECT `password` FROM users WHERE id=".$uid)->fetchColumn();
            if($oldPassDB == enc_pass($oldPass)){
                $_SESSION['db']->prepare("UPDATE users SET `password`=:pass WHERE id=:id")->execute(['id' => $uid,'pass' => enc_pass($newPass)]);
                return "done";    
            }else{
                return "Old Password Incorrect !!";
            }
        }else{
            return "Err :: Username Not Exist , May Deleted";
        }
    }
}