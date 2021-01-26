<?php

function base64ImgRegex($base64)
{
    $data = explode(',', $base64);
    return $data[1];
}

function Base64imgValidation($base64) {
    $img = @imagecreatefromstring(base64_decode(base64ImgRegex($base64)));
    if (!$img) {
        return false;
    }
    imagepng($img,'tmpChkProPIC.png');
    $info = @getimagesize('tmpChkProPIC.png');
    unlink('tmpChkProPIC.png');
    if ($info[0] > 0 && $info[1] > 0 && $info['mime']) {
        return true;
    }
    return false;
}

