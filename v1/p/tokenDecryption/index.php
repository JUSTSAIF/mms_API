<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-type: application/json');
require_once('../../pAPI.php');

//  Web API
if (isset($_GET['token_dec']) && isset($_GET['token_key'])) {
    $realToken = $_GET['token_dec'];
    $keyToken  = $_GET['token_key']; //"164fb8af76ba2f39fb5b61a3517ed361"
    $dec       = dec_token($keyToken, $realToken);
    $chk_exp   = checkExpire($realToken);
    if (valiDate(rgxDec($dec)['exp']) == "true") {
        if ($chk_exp == "token active") {
            echo json_encode(array(
                "token"               => $realToken,
                "status"              => "alive",
                "userID"              => (int)rgxDec($dec)['id'],
                "user_permissions"    => rgxDec($dec)['role'],
                "expire-time"         => rgxDec($dec)['exp']
            ));
        } elseif ($chk_exp == "token expired") {
            echo json_encode(array(
                "token"               => $realToken,
                "status"              => "dead",
                "userID"              => (int)rgxDec($dec)['id'],
                "user_permissions"    => rgxDec($dec)['role'],
                "expire-time"         => rgxDec($dec)['exp']
            ));
        }
    } else {
        echo json_encode(array(
            "status"    => "invalid token"
        ));
    }
}
