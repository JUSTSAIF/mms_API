<?php

function updateIP($token){
    $uid = GetUID($token);
    if($uid == "token expired"){
        return "token expired";
    }elseif($uid == "invalid token"){
        return "invalid token";
    }else{
        if(chkUsrExist((int)$uid)){
            if(isset($_GET['ip'])){
                $ip  =  $_GET['ip'];
                if(filter_var($ip, FILTER_VALIDATE_IP)){
                    $_SESSION['db']->prepare("UPDATE users SET `ip_addr`=:ia WHERE id=:id")->execute(['id' => $uid,'ia' => $ip]);
                    return "done";
                }else{
                    return "invalid ip addr !!";
                }
            }else{
                return "there are not Ip Addr was sended in GET Req !!";
            }
        }else{
            return "Err :: Username Not Exist , May Deleted";
        }
    }
}