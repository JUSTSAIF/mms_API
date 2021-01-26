<?php
// check User Permissions
function checkUsrPermissions($token){
    $index = dec_token($_SESSION['encKey'], $token);
    if(!empty($index)){
        if(checkExpire($token) == "token active"){
            return rgxDec($index)['role'];
        }else{
            return "token expired";
        }
    }else{
        return "invalid token";
    }
}