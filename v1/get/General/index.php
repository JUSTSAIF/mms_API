<?php
// Includes :: JSON retrun 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-type: application/json');
require_once('../../pAPI.php');



// API
if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $uid   = GetUID($token);
    if ($uid == "token expired") {
        echo  json_encode(array("res" => "token expired"));
    } elseif ($uid == "invalid token") {
        echo  json_encode(array("res" => "invalid token"));
    } else {
        if ((int)GetUID($token)) {
            echo json_encode(array(
                "buy_sec"   => buy_sec(),
                "count_sec" => GetInfo(),
                "design_settings" => design_settings()
            ));
        } else {
            echo  json_encode(array("res" => "User Not Exist Maybe Deleted !!"));
        }
    }
}



function buy_sec(){
    $MS_Data = $_SESSION['db']->query("SELECT * FROM `buy-section`;")->fetchAll();
    $data    = array();
    foreach ($MS_Data as $sData) {
        $data[] = array(
            "id" => (int)$sData['id'],
            "head" => $sData['head'],
            "price" =>  (int)$sData['price'],
            "SubscriptionTime" => $sData['SubscriptionTime'],
            "currencyType" => $sData['currencyType'],
            "productInfo"  => array(
                "1" => array(
                    "crossOff"  =>  PI_Dec($sData['productInfo_1'])['bool'],
                    "string"    =>  PI_Dec($sData['productInfo_1'])['string']
                ),
                "2" => array(
                    "crossOff"  =>  PI_Dec($sData['productInfo_2'])['bool'],
                    "string"    =>  PI_Dec($sData['productInfo_2'])['string']
                ),
                "3" => array(
                    "crossOff"  =>  PI_Dec($sData['productInfo_3'])['bool'],
                    "string"    =>  PI_Dec($sData['productInfo_3'])['string']
                ),
                "4" => array(
                    "crossOff"  =>  PI_Dec($sData['productInfo_4'])['bool'],
                    "string"    =>  PI_Dec($sData['productInfo_4'])['string']
                ),
                "5" => array(
                    "crossOff"  =>  PI_Dec($sData['productInfo_5'])['bool'],
                    "string"    =>  PI_Dec($sData['productInfo_5'])['string']
                ),
                "6" => array(
                    "crossOff"  =>  PI_Dec($sData['productInfo_6'])['bool'],
                    "string"    =>  PI_Dec($sData['productInfo_6'])['string']
                )
            ),
            "buttonText" => $sData['buttonText'],
            "redirect_link" => $sData['redirect_link'],
            "hide" => boolval($sData['hide']),
        );
    }
    return $data;
}

function design_settings()
{
    $MS_data = $_SESSION['db']->query('SELECT * FROM `site_info`;')->fetch();
    $data = array(
    "profile_pic_dir" => $MS_data['profile_pic_dir'],
    "design_img_dir"  => $MS_data['design_img_dir'],
    "not_found_pic"   => $MS_data['not_found_pic'],
    "desktop_bg"      => $MS_data['desktop_bg'],
    "mobile_bg"       => $MS_data['mobile_bg']
    );

    return $data;
}

function PI_Dec($PI)
{
    @$string = array();
    @$bool = array();
    @preg_match('/{(.*?)\}/s', $PI, $string);
    @preg_match('/2{(.*?)\}/s', $PI, $bool);
    @$string = $string[1];
    @$bool = $bool[1];
    return array("string" => $string, "bool" => (int)$bool);
}

function GetInfo()
{
    $hc = (int)$_SESSION['db']->query('SELECT COUNT(*) FROM users;')->fetchColumn();
    $GI = $_SESSION['db']->query('SELECT * FROM `site_info`')->fetch();
    return array("hc"    => $hc, "sp"    => (int)$GI['SoldProgram'], "pc"    => (int)$GI['ProgramsCreated']);
}
