<?php
// Includes :: JSON retrun 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-type: application/json');
require_once('../pAPI.php');
include('contact_function.php');
include('name_function.php');
include('reset_password_function.php');
include('username_function.php');

// API
if (isset($_POST['token'])) {
    $name = "done";
    $con  = "done";
    $pass = "done";
    $user = "done";
    if (isset($_POST['email']) & isset($_POST['fb']) & isset($_POST['ig'])) {
        $con = setContact($_POST['token'], $_POST['email'], $_POST['fb'], $_POST['ig']);
    }
    if (isset($_POST['newName'])) {
        $name = changeName($_POST['token'],  $_POST['newName']);
    }
    if (isset($_POST['oldPass']) & isset($_POST['newPass'])) {
        $pass = changePass($_POST['token'],  $_POST['oldPass'], $_POST['newPass']);
    }
    if(isset($_POST['newUSR'])){
        $user = changeUSR($_POST['token'], $_POST['newUSR']);
    }
    echo json_encode(array(
        "name"      => $name,
        "contact"   => $con,
        "newPass"   => $pass,
        "user"      => $user,
    ));
}
