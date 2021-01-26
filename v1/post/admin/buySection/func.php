<?php

function ChangeCard(
    $token,
    $cid,
    $head,
    $price,
    $SubscriptionTime,
    $currencyType,
    $productInfo_1,
    $productInfo_2,
    $productInfo_3,
    $productInfo_4,
    $productInfo_5,
    $productInfo_6,
    $buttonText,
    $redirect_link
) {
    // Start Function :: 
    $token = $_POST['token'];
    $uid   = GetUID($token);
    if ($uid == "token expired") {
        return "token expired";
    } elseif ($uid == "invalid token") {
        return "invalid token";
    } else {
        if (chkUsrExist((int)$uid) & (checkUsrPermissions($token) == "ar")) {
            try {
                $C_query = $_SESSION['db']->prepare("UPDATE `buy-section`
                SET 
                head=:head,
                price=:price,
                SubscriptionTime=:SubscriptionTime,
                currencyType=:currencyType,
                productInfo_1=:productInfo_1,
                productInfo_2=:productInfo_2,
                productInfo_3=:productInfo_3,
                productInfo_4=:productInfo_4,
                productInfo_5=:productInfo_5,
                productInfo_6=:productInfo_6,
                buttonText=:buttonText,
                redirect_link=:redirect_link,
                hide=0
                WHERE id=:id"
                )->execute([
                    'id'                => $cid,
                    'head'              => htmlspecialchars($head, ENT_QUOTES),
                    'price'             => htmlspecialchars($price, ENT_QUOTES),
                    'SubscriptionTime'  => htmlspecialchars($SubscriptionTime, ENT_QUOTES),
                    'currencyType'      => htmlspecialchars($currencyType, ENT_QUOTES),
                    'productInfo_1'     => htmlspecialchars($productInfo_1, ENT_QUOTES),
                    'productInfo_2'     => htmlspecialchars($productInfo_2, ENT_QUOTES),
                    'productInfo_3'     => htmlspecialchars($productInfo_3, ENT_QUOTES),
                    'productInfo_4'     => htmlspecialchars($productInfo_4, ENT_QUOTES),
                    'productInfo_5'     => htmlspecialchars($productInfo_5, ENT_QUOTES),
                    'productInfo_6'     => htmlspecialchars($productInfo_6, ENT_QUOTES),
                    'buttonText'        => htmlspecialchars($buttonText, ENT_QUOTES),
                    'redirect_link'     => htmlspecialchars($redirect_link, ENT_QUOTES)
                ]);
                if($C_query){
                    return "Card " . $cid . " Changed Successfully";
                }else{
                    return "Card Change Failed";
                }
            } catch (\Throwable $th) {
                return "Card Change Failed";
            }
        } else {
            return "Don't Have permissions !";
        }
    }
}


// substr($productInfo_1, 0, 22)
// substr($productInfo_2, 0, 22)
// substr($productInfo_3, 0, 22)
// substr($productInfo_4, 0, 22)
// substr($productInfo_5, 0, 22)
// substr($productInfo_6, 0, 22)