<?php

// expT :: Expire Accounts Time ::
// 1 Hour  :: 12 Hour :: 1 Day
// 1 Week  :: 2 Weeks
// 1 Month :: 3 Month
// 1 Year  :: 3 Years ::5 Years
// LifeTime
// Function Syntax : [ 1h, 12h, 1d, 1w, 2w, 1m, 3m, 1y, 3y, 5y, lifetime ]

function GetExp($expT){
    if($expT == "1h"){
        return gmdate('Y-m-d h:i:s', time()+3600);
    }elseif($expT == "12h"){
        return gmdate('Y-m-d h:i:s', time()+(3600*12));
    }elseif($expT == "1d"){
        return gmdate('Y-m-d h:i:s', time()+3600*24);
    }elseif($expT == "1w"){
        return gmdate('Y-m-d h:i:s', time()+(3600*24)*7);
    }elseif($expT == "2w"){
        return gmdate('Y-m-d h:i:s', time()+(3600*24)*14);
    }elseif($expT == "1m"){
        return gmdate('Y-m-d h:i:s', time()+(3600*24)*30);
    }elseif($expT == "3m"){
        return gmdate('Y-m-d h:i:s', time()+(3600*24)*90);
    }elseif($expT == "1y"){
        return gmdate('Y-m-d h:i:s', time()+(3600*24)*360);
    }elseif($expT == "3y"){
        return gmdate('Y-m-d h:i:s', time()+(3600*24)*1080);
    }elseif($expT == "5y"){
        return gmdate('Y-m-d h:i:s', time()+(3600*24)*1440);
    }elseif($expT == "lifetime"){
        return "lifetime";
    }else{
        return "Err :: Select One Of This : [1h,12h,1d,1w,2w,1m,3m,1y,3y,5y,lifetime]";
    }
}