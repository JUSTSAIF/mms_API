<?php

// Check If Token Expired Or Not !
function checkExpire($token){
    $chk_e = rgxDec(dec_token($_SESSION['encKey'],$token))['exp'];
    if(!empty($chk_e)){
        $expire = strtotime($chk_e);
        $today = strtotime("today midnight");
        if($today >= $expire){
            return "token expired";
        } else {
            return "token active";
        }
    }else{
        return "invalid token";
    }
}

function getTokenDate($token){
    return  rgxDec(dec_token($_SESSION['encKey'],$token))['exp'];
}


// Check If Token Expired Or Not !
function checkExpireAdmin($token){
    $chk_e = rgxDec(dec_token($_SESSION['encKey'],$token))['exp'];
    if(!empty($chk_e)){
        $expire = strtotime($chk_e);
        $today = strtotime("today midnight");
        if($today >= $expire){
            return "token expired";
        } else {
            if(checkUsrPermissions($token) == "an" | checkUsrPermissions($token) == "ar"){
                return "token active";
            }else{
                return "invalid token, this token for user account !!";
            }
        }
    }else{
        return "invalid token";
    }
}