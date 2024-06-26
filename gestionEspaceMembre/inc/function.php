<?php

function debug($variable){
    echo "<pre>".print_r($variable,true)."</pre>";
}

function str_random($length){
    $alphabet = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789";
    return $alphabet = substr(str_shuffle(str_repeat($alphabet, $length)),0,$length);


}

function logged_only(){
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    if(!isset($_SESSION["auth"])){
        $_SESSION["flash"]["danger"] = "Tu n'es pas autorisé à accéder à cette page";
        header("Location: login.php");
        exit();
    }
}

?>