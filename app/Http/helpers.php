<?php
function checkPermission($permissions){
    $userAccess = getMyPermission(auth()->user()->user_type);
    foreach ($permissions as $key => $value) {
        if($value == $userAccess){
            return true;
        }
    }
    return false;
}


?>
