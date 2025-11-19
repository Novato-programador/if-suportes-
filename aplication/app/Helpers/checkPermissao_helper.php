<?php 
function checkePermissao() {
    $_token = session()->get("token");
    if ($_token) {
        $user = base64_decode($_token);
        $userJson = json_decode($user);

        $userJson->nivel;
        if ($userJson->nivel==="admin") {
            return "block";
        }
    }
    return  "none" ;
}