<?php 

function chkUsrValid($username){
    if(preg_match('/^[a-zA-Z0-9_]{1,20}$/', $username)) { 
        return true;
    }else{
        return false;
    }
}