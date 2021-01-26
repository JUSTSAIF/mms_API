<?php

function checkLogin($username, $password){
    if(chkUsrExistByUsername($username) & $username != ""){
        $enc_pass = enc_pass($password);
        $RealPass = $_SESSION['db']->query('SELECT `password` FROM `users` WHERE `username`="'.$username.'"')->fetchColumn();
        $uid      = $_SESSION['db']->query('SELECT `id` FROM `users` WHERE `username`="'.$username.'"')->fetchColumn();
        $roleID   = $_SESSION['db']->query('SELECT `roleID` FROM `user_role` WHERE `userID`="'.$uid.'"')->fetchColumn();
        if($RealPass == $enc_pass){
            return array("res"=>"login success","roleID"=>(int)$roleID);
        }else{
            return "incorrect password !";
        }
    }else{
        return "User Not Exist !!";
    }
}