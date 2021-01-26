<?php

function setProfilePhoto($token, $base64){
    $uid = GetUID($token);
    if($uid == "token expired"){
        return "token expired";
    }elseif($uid == "invalid token"){
        return "invalid token";
    }else if("token active"){
        if(Base64imgValidation($base64)){
            $imageName   =  $_SESSION['db']->query("SELECT pic FROM users WHERE id=".$uid)->fetchColumn();
            if($imageName == ""){
                $imageName   = "id_".$uid."_rand.".bin2hex(random_bytes(3));
            }
            $imgPath     =  "../../../../Database/profilePIC/" . $imageName . ".png";
            if(file_exists($imgPath) & is_file($imgPath)){
                try{
                    unlink($imgPath);
                }finally{
                    $base64Image = base64_decode(base64ImgRegex($base64));
                    $im          = imageCreateFromString($base64Image);        
                    ($im) ? imagepng($im, $imgPath, 0) :null;
                }
            }else{
                $base64Image = base64_decode(base64ImgRegex($base64));
                $im          = imageCreateFromString($base64Image);    
                $_SESSION['db']->prepare("UPDATE users SET pic=:pic WHERE id=:id")->execute(['id' => $uid,'pic' => $imageName]);
                ($im) ? imagepng($im, $imgPath, 0) :null;
            }
            return "Done";
        }else{
            return "invalid base64 image";
        }
    }
}