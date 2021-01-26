<?php

function chkAccExp($token){
    $uid = GetUID($token);
    if($uid == "token expired"){
        return "token expired";
    }elseif($uid == "invalid token"){
        return "invalid token";
    }else{
        if(chkUsrExist((int)$uid)){
            date_default_timezone_set("GMT");
            $regYMD    =   '/(\d{4})-(\d{2})-(\d{2})/';
            $regHMS    =   '/(\d{2}):(\d{2}):(\d{2})/';
            $NOW       =   new DateTime("NOW");
            $nowYMD    =   strtotime($NOW->format('Y-m-d'));
            $nowDT     =   $NOW->format('Y-m-d h:i:s');
            $EXP       =   $_SESSION['db']->query("SELECT `expire-date` FROM users WHERE id=".$uid)->fetchColumn();
            if($EXP == "lifetime"){
                return "Lifetime Activated";
            }else{
                if(empty($EXP)){
                    return "Not Activated";
                }else{
                    preg_match($regHMS, $EXP, $expHMS);
                    preg_match($regYMD, $EXP, $expYMD);
                    $expYMD   =   strtotime(@$expYMD[1]."-".@$expYMD[2]."-".@$expYMD[3]);
                    $expHMS   =   strtotime(@$expHMS[1].":".@$expHMS[2].":".@$expHMS[3]);
                    $nowHMS    =  strtotime($NOW->format('h:i:s'));
        
                    // ==========
                    if($nowYMD > $expYMD){
                        return "Expired";
                    } else {
                        if ($expHMS < $nowHMS) {
                            return 'Expired';
                        } else {
                            return getDateDiff($EXP,$nowDT);
                        }                
                    }    
                }
            }
        }
    }
}

function getDateDiff($t1, $t2){
    $date1      =    strtotime($t1); 
    $date2      =    strtotime($t2);  
    $diff       =    abs($date2 - $date1);  
    $years      =    floor($diff / (365*60*60*24));  
    $months     =    floor(($diff - $years * 365*60*60*24) / (30*60*60*24));  
    $days       =    floor(($diff - $years * 365*60*60*24 -  $months*30*60*60*24)/ (60*60*24)); 
    $hours      =    floor(($diff - $years * 365*60*60*24  - $months*30*60*60*24 - $days*60*60*24) / (60*60));  
    $minutes    =    floor(($diff - $years * 365*60*60*24  - $months*30*60*60*24 - $days*60*60*24  - $hours*60*60)/ 60);  
    $seconds    =    floor(($diff - $years * 365*60*60*24  - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minutes*60));  
    return $years."Y-".$months."M-".$days."D & ".$hours.":".$minutes.":".$seconds;
}