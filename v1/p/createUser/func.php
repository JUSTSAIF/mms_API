<?php

// Roles ::
$roles = array("ar","an","ur","nl");

// Create User Func
function CreateUserAPI($role, $name, $username, $password, $expire_date){
    $expire_date = GetExp($expire_date);
    if($role == "ar"){$role = 1;}elseif($role == "an"){$role = 2;}elseif($role == "ur"){$role = 3;}else{$role = 4;}
    if(chkUsrValid($username)){
        $checkUsername = $_SESSION['db']->query("SELECT username FROM users WHERE username ='".$username."'")->fetchColumn();
        if($checkUsername == false){
            if($expire_date == "Err :: Select One Of This : [1h,12h,1d,1w,2w,1m,3m,1y,3y,5y,lifetime]"){
                return "Err :: Check TimeLimit::Exp";
            }else{
                $name          =    base64_encode(htmlspecialchars($_POST['name'], ENT_QUOTES));
                $username      =    htmlspecialchars($_POST['username'], ENT_QUOTES);
                $password      =    enc_pass($_POST['password']);
                $Uquery = "INSERT INTO users (`name`, `username`, `password`, `create-date`, `expire-date`,`Subscription-create-date`,`ip_addr`,`pic`,`last_active`) VALUES (?,?,?,?,?,?,?,?,?)";
                $_SESSION['db']->prepare($Uquery)->execute([$name, $username, $password,gmdate('Y-m-d h:i:s a'), $expire_date,gmdate('Y-m-d h:i:s a'),"","","" ]);
                $accID = $_SESSION['db']->query("SELECT `id` FROM `users` WHERE `username` LIKE '$username'")->fetchColumn();
                $_SESSION['db']->prepare("INSERT INTO user_role (`userID`, `roleID`) VALUES (?, ?);")->execute([(int)$accID, (int)$role]);
                for ($i=0; $i < 3 ; $i++) {
                    if($i == 0){$t="fb";}elseif($i == 1){$t="ig";}elseif($i == 2){$t="email";}
                    $_SESSION['db']->prepare("INSERT INTO contact_links (`userID`, `contactType`, `contactVal`) VALUES (?, ?, ?);")->execute([(int)$accID, $t   , null]);
                }
                return "User Created successfully";
            }
        }else{
            return "Username Already Exist !";
        }
    }else{
        return "invalid username";
    }
}