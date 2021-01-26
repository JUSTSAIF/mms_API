<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-type: application/json');
require_once('../../pAPI.php');

// API
if(isset($_GET['uid'])){
    if(is_numeric($_GET['uid'])){
        if(chkUsrExist((int)$_GET['uid'])){
            echo json_encode(array("msg"=>"User Exist"));
        }else{
            echo json_encode(array("msg"=>"User Not Exist"));
        }    
    }else{
        echo json_encode(array("msg"=>"accept just numbers"));
    }    
}



