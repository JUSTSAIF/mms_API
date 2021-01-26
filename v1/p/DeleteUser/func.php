<?php 


function userDelete($uid,$token){
    try {
        if( chkUsrExist((int)$uid) & !empty($uid) ){
            if(checkUsrPermissions($token) == "ar" ){
                $userRole =  $_SESSION['db']->query("SELECT `roleID` FROM user_role WHERE userID =".$uid)->fetchColumn();
                if((int)$userRole != 1){
                    $DeleteAvatar =  $_SESSION['db']->query("SELECT `pic` FROM users WHERE id =".$uid)->fetchColumn();
                    unlink("../../../../Database/profilePIC/".$DeleteAvatar.".png");
                    $query =  $_SESSION['db']->query("DELETE FROM users WHERE id =".$uid)->execute();
                    if($query){
                        return "Done";
                    }else{
                        return "Err MySQL";
                    }    
                }else{
                    return "Can Not Delete Administrator User";
                }
            }else{
                return "don't have permissions to delete !";
            }
        }else{
            return "user not exist !";
        }    
    } catch (\Throwable $th) {
        return "Err !";
    }
    
}
