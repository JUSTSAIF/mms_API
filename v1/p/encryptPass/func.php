<?php


// Encrypting Passwords
function enc_pass($pass){
    $rot13          = str_rot13($pass);
    $base64         = base64_encode($rot13);
    $b64ToRot13     = str_rot13($base64);
    $md5tob64       = md5($b64ToRot13);
    $md5toRot13     = str_rot13($md5tob64);
    $_rt13          = base64_encode($md5toRot13);
    $_end           = str_rot13($_rt13);
    return $_end;
}

