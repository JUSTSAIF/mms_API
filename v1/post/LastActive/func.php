<?php

function updateLastAct($token){
    $uid = GetUID($token);
    if($uid == "token expired"){
        return "token expired";
    }elseif($uid == "invalid token"){
        return "invalid token";
    }else{
        if(chkUsrExist((int)$uid)){
            $_SESSION['db']->prepare("UPDATE users SET `last_active`=:la WHERE id=:id")->execute(['id' => $uid,'la' => gmdate("Y-m-d h:i:s a")]);
            return "done";
        }else{
            return "Err :: Username Not Exist , May Deleted";
        }
    }
}