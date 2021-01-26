<?php
// Includes :: JSON retrun 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-type: application/json');
require_once('../../pAPI.php');

// ============= API =============
if(isset($_POST['token']) & isset($_POST['uid'])){
    $uid = $_POST['uid'];
    $token = $_POST['token'];
    if(isset($_POST['tl'])){
        echo  json_encode(array("msg" => SetAExpire($_POST['tl'], $token, $uid)));
    }elseif(isset($_POST['role'])){
        echo  json_encode(array("msg" => SetRole($_POST['role'], $token, $uid)));
    }else{
        echo  json_encode(array("msg" => "Err :: Select Option"));    
    }
}


// ============= functions =============

// F1
function SetAExpire($TL, $sToken, $uid){
    if((checkUsrPermissions($sToken) == "ar") | (checkUsrPermissions($sToken) == "an")){
        if(chkUsrExist((int)$uid)){
            $ex = GetExp($TL);
            if($ex == "Err :: Select One Of This : [1h,12h,1d,1w,2w,1m,3m,1y,3y,5y,lifetime]"){
                return "Err :: Check TimeLimit";
            }else{
                $_SESSION['db']->prepare("UPDATE users SET `expire-date`=:ex WHERE id=:id")->execute(['id' => $uid,'ex' => $ex]);
                $_SESSION['db']->prepare("UPDATE users SET `Subscription-create-date`=:cd WHERE id=:id")->execute(['id' => $uid,'cd' => gmdate('Y-m-d h:i:s')]);
                return "done";    
            }
        }else{
            return "UserID Not Exist !!";
        }    
    }else{
        return "Err :: May u are not admin !";
    }
}

// F2
function SetRole($role, $sToken, $uid){
    if(checkUsrPermissions($sToken) == "ar"){
        if(chkUsrExist((int)$uid)){
            $roles = array(1,2,3,4);
            if(in_array($role, $roles)){
                $_SESSION['db']->prepare("UPDATE user_role SET `roleID`=:rid WHERE userID=:id")->execute(['id' => $uid,'rid' => $role]);
                return "done";        
            }else{
                return "RoleID not Exist !!";
            }
        }else{
            return "UserID Not Exist !!";
        }    
    }else{
        return "Err :: May u are not admin !";
    }
}