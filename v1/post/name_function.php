<?php

function changeName($token, $newName){
    $uid = GetUID($token);
    if($uid == "token expired"){
        return "token expired";
    }elseif($uid == "invalid token"){
        return "invalid token";
    }else{
        if(chkUsrExist((int)$uid)){
            $newName = base64_encode($newName);
            $_SESSION['db']->prepare("UPDATE users SET `name`=:name WHERE id=:id")->execute(['id' => $uid,'name' => $newName]);
            return "done";
        }else{
            return "Err :: Username Not Exist , May Deleted";
        }
    }
}
