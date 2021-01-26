<?php

// check User Permissions
function GetUID($token){
    $index = dec_token($_SESSION['encKey'], $token);
    if(!empty($index)){
        if(checkExpire($token) == "token active"){
            return rgxDec($index)['id'];
        }else{
            return "token expired";
        }
    }else{
        return "invalid token";
    }
}
