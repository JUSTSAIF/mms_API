<?php
// Includes :: JSON retrun 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-type: application/json');
require_once('../pAPI.php');


// API
if( isset($_GET['token']) ){
    $uid = GetUID($_GET['token']);
    if($uid == "token expired"){
        echo  json_encode(array(
            "res" => "token expired"
        )); 
    }elseif($uid == "invalid token"){
        echo  json_encode(array(
            "res" => "invalid token"
        )); 
    }else {
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
            echo  json_encode(array(
                "Contact"       => [
                    "facebook"=>$fb,
                    "instagram"=>$ig,
                    "email"=>$email
                ],
                "Account_Create_Time"       => $data['create-date'],
                "Subscription_create_date"  => $data['Subscription-create-date'],
                "ExpireTime"                => $data['expire-date'],
                "IP"                        => $data['ip_addr'],
                "LastActive"                => $data['last_active'],
                "Name"                      => base64_decode( $data['name']),
                "ProfilePic"                => $pic,
                "Username"                  =>  $data['username']
            ));
        }else{
            echo  json_encode(array(
                "res" => "User Not Exist !"
            ));        
        }
    }
}