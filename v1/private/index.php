<?php
// Includes :: JSON retrun 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-type: application/json');
require_once('../pAPI.php');


// API

if(isset($_POST['username']) & isset($_POST['password'])){
    echo json_encode(array(
        "res" => LOGIN_API($_POST['username'],$_POST['password'])
    ));
}



// Function
function LOGIN_API($username, $password){
    if(chkUsrExistByUsername($username) & $username != ""){
        $enc_pass = enc_pass($password);
        $RealPass = $_SESSION['db']->query('SELECT `password` FROM `users` WHERE `username`="'.$username.'"')->fetchColumn();
        $uid      = $_SESSION['db']->query('SELECT `id` FROM `users` WHERE `username`="'.$username.'"')->fetchColumn();
        $roleID   = $_SESSION['db']->query('SELECT `roleID` FROM `user_role` WHERE `userID`="'.$uid.'"')->fetchColumn();
        $expire   = $_SESSION['db']->query('SELECT `expire-date` FROM `users` WHERE `id`="'.$uid.'"')->fetchColumn();
        if($RealPass == $enc_pass){
            if((int)$roleID != 4){
                if($expire == "lifetime"){
                    return "LoggedIn Success";
                }else if(strtotime("today midnight") >= strtotime($expire)){
                    return "Expired Account";
                } else {
                    return "LoggedIn Success";
                }
            }else{
                return "you have been banned by admin !!";
            }
            
        }else{
            return "incorrect password !";
        }
    }else{
        return "User Not Exist !!";
    }
}