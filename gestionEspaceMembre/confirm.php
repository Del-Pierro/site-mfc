<?php

$user_id = $_GET["id"];
$token = $_GET["token"];

require_once "inc/db.php";
$req = $pdo->prepare("SELECT * FROM espacemembre WHERE id=?");
$req->execute([$user_id]);

$user = $req->fetch();
session_start();
if($user && $user->confirmation_token == $token){
    $req = $pdo->prepare("UPDATE espacemembre SET confirmed_at=NOW(), confirmation_token=NULL WHERE id=?");
    $req->execute([$user_id]);

    $_SESSION["auth"] = $user;
    $_SESSION["flash"]["success"] = "Votre compte a bien été validé";
    header("Location: account.php");
}else{
    $_SESSION["flash"]["danger"] = "Ce token n'est plus valide";
    header("Location: login.php");
}

?>