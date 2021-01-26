<?php

// Func
// $Type : 
// 1 = email
// 2 = instagram
// 3 = facebook
function setContact($token, $email, $fb, $ig)
{
    $uid = GetUID($token);
    if ($uid == "token expired") {
        return "token expired";
    } elseif ($uid == "invalid token") {
        return "invalid token";
    } else {
        if (chkUsrExist((int)$uid)) {
            if (chkEmailValid($email) && chkUsrValid($fb) && chkUsrValid($ig)) {
                updateContact($uid, "email", $email);
                updateContact($uid, "fb", $fb);
                updateContact($uid, "ig", $ig);
                return "done";
            } elseif ($email == "" & $fb == "" & $ig == "") {
                updateContact($uid, "email","");
                updateContact($uid, "fb",   "");
                updateContact($uid, "ig",   "");
                return "done";
            } else {
                return "Err :: incorrect data !! ";
            }
        }
    }
}
function updateContact($uid, $Type, $data)
{
    $data = base64_encode(htmlspecialchars($data, ENT_QUOTES));
    $Type = htmlspecialchars($Type, ENT_QUOTES);
    $_SESSION['db']->prepare("UPDATE `contact_links` SET contactVal=:val WHERE userID=:id AND contactType=:conType")->execute(['id' => $uid, 'val' => $data, 'conType' => $Type]);
}
