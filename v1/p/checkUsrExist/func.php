<?php

function chkUsrExist($uid){
    if(is_string($uid)){
        return false;
    }else{
        $chk = $_SESSION['db']->query("SELECT id FROM users WHERE id=".$uid)->fetchColumn();
        if($chk == $uid){
            return true;
        }else{
            return false;
        }    
    }
}

function chkUsrExistByUsername($usr){
    $chk = $_SESSION['db']->query('SELECT `username` FROM `users` WHERE `username`="'.$usr.'"')->fetchColumn();
    if($chk == $usr){
        return true;
    }else{
        return false;
    }    
}
