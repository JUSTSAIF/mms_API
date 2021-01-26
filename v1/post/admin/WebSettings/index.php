<?php
// Includes :: JSON retrun 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-type: application/json');
require_once('../../../pAPI.php');

// ============= API =============
if (isset($_POST['token'])) {
    if (isset($_POST['NFAU']) & isset($_POST['UADU']) & isset($_POST['WID'])) {
        echo  json_encode(array("msg" => change_web_settings($_POST['token'], $_POST['NFAU'], $_POST['UADU'], $_POST['WID'])));
    }elseif(isset($_POST['desktop']) & isset($_POST['mobile'])){
        echo  json_encode(array("msg" => change_background_images($_POST['token'], $_POST['desktop'], $_POST['mobile'])));
    }
}

// ============= functions =============

// F1
function change_web_settings($token, $NFAU, $UADU, $WID)
{
    if (chkUsrExist((int)GetUID((int)$token)) & (checkUsrPermissions($token) == "ar")) {
        $q =    $_SESSION['db']->prepare("UPDATE `site_info` SET 
            profile_pic_dir=:UADU,
            design_img_dir=:WID,
            not_found_pic=:NFAU
            WHERE mayid=0 ")->execute([
            'NFAU'  =>  htmlspecialchars($NFAU, ENT_QUOTES),
            'UADU'  =>  htmlspecialchars($UADU, ENT_QUOTES),
            'WID'   =>  htmlspecialchars($WID, ENT_QUOTES)
        ]);
        if ($q) {
            return "changed Successfully";
        } else {
            return "Change Failed";
        }
    } else {
        return "Err :: May u are not admin !";
    }
}

// F2
function change_background_images($token, $bg_desk, $bg_mob)
{
    if (chkUsrExist((int)GetUID((int)$token)) & (checkUsrPermissions($token) == "ar")) {
        $q =    $_SESSION['db']->prepare("UPDATE `site_info` SET  mobile_bg=:bg_mob, desktop_bg=:bg_desk WHERE mayid=0")->execute(['bg_desk' => (int)$bg_desk, 'bg_mob'  => (int)$bg_mob]);
        if ($q) {
            return "changed Successfully";
        } else {
            return "Change Failed";
        }
    } else {
        return "Err :: May u are not admin !";
    }
}
