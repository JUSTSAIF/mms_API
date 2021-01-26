<?php


// gen Random iv  & key  
// $iv         = bin2hex (random_bytes(8));
// $key        = bin2hex(random_bytes(16));

// Encrypting Token :: Generator
// ar :: administrator
// an :: admin
// ur :: user
// nl :: null

function gen_token($userID,$role){
    $iv             = $_SESSION['ivKey'];
    $key            = $_SESSION['encKey'];
    $defaultToken   = "t{".date('Y-m-d', strtotime('+3 day'))."}"." r{".$role."}"." id{".$userID."}";
    $encrypted      = openssl_encrypt($defaultToken, "AES-256-CBC", $key,0,$iv);
    $iv_enc         = $iv.":".$encrypted;
    // DB & Cookie
    // $_SESSION['db']->query("UPDATE `users` SET `token` = '$key' WHERE `users`.`id` = $userID;");
    setcookie("token", $iv_enc, time()+(10*365*24*60*60), "/");
    return $iv_enc;
}


