<?php

function changeUSR($token, $newUSR){
    $uid = GetUID($token);
    if($uid == "token expired"){
        return "token expired";
    }elseif($uid == "invalid token"){
        return "invalid token";
    }else{
        if(chkUsrExist((int)$uid)){
            if(chkUsrValid($newUSR)){
                try {
                    $_SESSION['db']->prepare("UPDATE users SET `username`=:usr WHERE id=:id")->execute(['id' => $uid,'usr' => $newUSR]);
                    return "done";
                } catch (\Throwable $th) {
                    return "Err :: Username Unavailable";
                }
            }else{
                return "Err :: Invalid Username";
            }
        }else{
            return "UserID Not Exist !!";
        }        
    }
}