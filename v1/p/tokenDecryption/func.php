<?php

// regex
function rgxDec($rgx)
{
    @$tokenEXP = array();
    @$tokenROLE = array();
    @$tokenID = array();
    @preg_match('/t{(.*?)\}/s', $rgx, $tokenEXP);
    @preg_match('/r{(.*?)\}/s', $rgx, $tokenROLE);
    @preg_match('/id{(.*?)\}/s', $rgx, $tokenID);
    @$tokenEXP = $tokenEXP[1];
    @$tokenROLE = $tokenROLE[1];
    $tokenID = $tokenID[1];
    // u can return 1 , exp or role,id like :: rgxDec("regex")['exp']
    $return = array(
        "exp"   =>  @$tokenEXP,
        "role"  =>  @$tokenROLE,
        "id"    =>  @$tokenID
    );
    return $return;
}

// Decrypting Token ::
function dec_token($key, $enc)
{
    @$parts     = explode(':', $enc);
    @$iv_e      = $parts[0];
    @$enc_e     = $parts[1];
    @$dec_token =  openssl_decrypt($enc_e, "AES-256-CBC", $key, 0, $iv_e);
    return $dec_token;    
}

function valiDate($date, $format = 'Y-m-d')
{
    if (DateTime::createFromFormat($format, $date) !== FALSE) {
        return "true";
    } else {
        return "false";
    }
}
