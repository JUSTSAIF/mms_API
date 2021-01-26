<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-type: application/json');
require_once('../../pAPI.php');
// echo gen_token(2,"an");

//  Web API
if( isset($_POST['username']) & isset($_POST['password']) ){
    $user = $_POST['username'];
    $pass = enc_pass($_POST['password']);
    // Check User
    if(chkUsrExistByUsername($user)){
        // Check Pass
        $Real_pass = $_SESSION['db']->query("SELECT `password` FROM `users` WHERE `username` LIKE '$user'")->fetchColumn();
        if($pass == $Real_pass){
            // Get User Role 
            $uid = $_SESSION['db']->query("SELECT `id` FROM `users` WHERE `username` LIKE '$user'")->fetchColumn();
            $roleID = $_SESSION['db']->query("SELECT `roleID` FROM `user_role` WHERE `userID` LIKE '$uid'")->fetchColumn();
            if($roleID == 1){$roleID = "ar";}elseif($roleID == 2){$roleID = "an";}elseif($roleID == 3){$roleID = "ur";}else{$roleID = "nl";}
            // Gen Token
            echo json_encode(array(
                "msg"        => "token created successfully",
                "username" => $user,
                "user_id"  => (int)$uid,
                "token"      => gen_token($uid,$roleID)
            ));
        }else {
            echo json_encode(array("user" => $user,"msg" => "password incorrect"));
        }
    }else {
        echo json_encode(array("user" => $user,"msg" => "User Not Exist in Our Database !!"));    
    }
}