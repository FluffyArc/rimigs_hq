?php
function checkPermission($permissions){
    $userAccess = getMyPermission(auth()->user()->user_type);
    foreach ($permissions as $key => $value) {
        if($value == $userAccess){
            return true;
        }
    }
    return false;
}


function getMyPermission($id)
{
    switch ($id) {
        case teacher:
            return 'admin';
            break;
        default:
            return 'user';
            break;
    }
}


?>
