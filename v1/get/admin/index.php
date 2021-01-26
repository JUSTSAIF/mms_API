<?php
// Includes :: JSON retrun 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-type: application/json');
require_once('../../pAPI.php');


// API
if( isset($_GET['token']) ){
    $token = $_GET['token'];
    $uid   = GetUID($token);
    if($uid == "token expired"){
        echo  json_encode(array(
            "res" => "token expired"
        )); 
    }elseif($uid == "invalid token"){
        echo  json_encode(array(
            "res" => "invalid token"
        )); 
    }else {
        if(chkUsrExist((int)$uid) & (checkUsrPermissions($token) == "ar" |checkUsrPermissions($token) == "an")){
            if(isset($_GET['uid'])){
                $uid = $_GET['uid'];
                if(chkUsrExist((int)$uid)){
                    $data   = $_SESSION['db']->query("SELECT * FROM users WHERE id=".$uid)->fetch();
                    $fb     = base64_decode($_SESSION['db']->query("SELECT `contactVal` FROM `contact_links` WHERE `userID` = ".$uid." AND `contactType`='fb'")->fetchColumn());
                    $ig     = base64_decode($_SESSION['db']->query("SELECT `contactVal` FROM `contact_links` WHERE `userID` = ".$uid." AND `contactType`='ig'")->fetchColumn());
                    $email  = base64_decode($_SESSION['db']->query("SELECT `contactVal` FROM `contact_links` WHERE `userID` = ".$uid." AND `contactType`='email'")->fetchColumn());
                    $PP_Dir = $_SESSION['db']->query("SELECT `profile_pic_dir` FROM `site_info`")->fetchColumn();
                    $pic    = "";
                    if($data['pic'] != ""){
                        $pic =  $PP_Dir . $data['pic'] . ".png";
                    }else{
                        $pic =  $_SESSION['db']->query("SELECT `not_found_pic` FROM `site_info`")->fetchColumn();
                    }
                    ($fb == false)?$fb = null:null;
                    ($ig == false)?$ig = null:null;
                    ($email == false)?$email = null:null;
                    $role = $_SESSION['db']->query("SELECT `roleId` FROM `user_role` WHERE `userID` = ".$uid)->fetchColumn();
                    if($role == 1){
                        $role = "administrator";
                    }else if($role == 2){
                        $role = "admin";
                    }else if($role == 3){
                        $role = "user";
                    }else{
                        $role = "None";
                    }
                    echo  json_encode(array(
                        "Contact"       => [
                            "facebook"=>$fb,
                            "instagram"=>$ig,
                            "email"=>$email
                        ],
                        "Account_Create_Time"       => $data['create-date'],
                        "Subscription_create_date"  => $data['Subscription-create-date'],
                        "ExpireTime"                => $data['expire-date'],
                        "IP"                        => $data['ip_addr'] == "" ? "No One LoggedIn Yet" : $data['ip_addr'],
                        "LastActive"                => $data['last_active'],
                        "Name"                      => base64_decode( $data['name']),
                        "ProfilePic"                => $pic,
                        "Username"                  =>  $data['username'],
                        "role"                  =>  $role
                    ));
                }else{
                    echo  json_encode(array(
                        "res" => "User Not Exist !"
                    ));        
                }        
            }else{
                $data          = $_SESSION['db']->query("SELECT * FROM users")->fetchAll();
                $PP_Dir        = $_SESSION['db']->query("SELECT `profile_pic_dir` FROM `site_info`")->fetchColumn();
                $list          = array();
                $pic           = "";
    
                foreach ($data as $row) {
                    $fb     = base64_decode($_SESSION['db']->query("SELECT `contactVal` FROM `contact_links` WHERE `userID` = ".$row['id']." AND `contactType`='fb'")->fetchColumn());
                    $ig     = base64_decode($_SESSION['db']->query("SELECT `contactVal` FROM `contact_links` WHERE `userID` = ".$row['id']." AND `contactType`='ig'")->fetchColumn());
                    $email  = base64_decode($_SESSION['db']->query("SELECT `contactVal` FROM `contact_links` WHERE `userID` = ".$row['id']." AND `contactType`='email'")->fetchColumn());
                    ($fb == false)?$fb = null:null;
                    ($ig == false)?$ig = null:null;
                    ($email == false)?$email = null:null;
                    $role  = $_SESSION['db']->query("SELECT `roleId` FROM `user_role` WHERE `userID` = ".$row['id'])->fetchColumn();
                    if($role == 1){
                        $role = "administrator";
                    }else if($role == 2){
                        $role = "admin";
                    }else if($role == 3){
                        $role = "user";
                    }else{
                        $role = "None";
                    }
    
                    if($row['pic'] != ""){
                        $pic =  $PP_Dir . $row['pic'] . ".png";
                    }else{
                        $pic =  $_SESSION['db']->query("SELECT `not_found_pic` FROM `site_info`")->fetchColumn();
                    }
                    $list[] = array(
                        'id' => (int)$row['id'],
                        'Username' => $row['username'],
                        'Name' => base64_decode( $row['name']),
                        'IP' => $row['ip_addr'] == "" ? "No One LoggedIn Yet" : $row['ip_addr'],
                        'LastActive' => $row['last_active'],
                        'ProfilePic' => $pic,
                        'ExpireTime' => $row['expire-date'],
                        'Subscription_create_date' => $row['Subscription-create-date'],
                        'Account_Create_Time' => $row['expire-date'],
                        'Contact' => [
                            "email" => $email,
                            "instagram" => $ig,
                            "facebook" => $fb,
                        ],
                        'role'=> $role
                        
                    );
                }
                echo json_encode($list);    
            }
        }else{
            echo  json_encode(array(
                "res" => "You do not have permissions to view this data !"
            ));
        }
    }
}




// $UsersNum      = $_SESSION['db']->query("SELECT COUNT(*) FROM `users`;")->fetchColumn();
