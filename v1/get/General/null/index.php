<?php
// Includes :: JSON retrun 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-type: application/json');
require_once('../../../pAPI.php');



// API
echo json_encode(array(
    "design_settings" => design_settings()
));


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