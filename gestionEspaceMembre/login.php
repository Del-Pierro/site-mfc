<?php

if(!empty($_POST) && !empty($_POST["identifiant"]) && !empty($_POST["password"])){
    require_once("inc/db.php");
    require_once "inc/function.php";

    $req = $pdo->prepare("SELECT * FROM espacemembre WHERE pseudo=:identifiant OR email=:identifiant");
    $req->execute(["identifiant" => $_POST["identifiant"]]);

    $user = $req->fetch();

    session_start();
    if(password_verify($_POST["password"], $user->password)){
        $_SESSION["auth"] = $user;
        $_SESSION["flash"]["success"] = "Vous êtes maintenant connecté";
        //header("Location: account.php");
        header("Location: C:\Users\delpierro\Music\MFC\index.html");
        exit();
    }else{
        $_SESSION["flash"]["danger"] = "Identifiant ou mot de passe incorrect";
    }
}

?>

<?php
    require_once("inc/begin.php"); 
?>

<h1>Se connecter</h1>
<form action="" method="post">
    <div class="form-group mb-3">
        <label for="identifiant">Email ou pseudo</label>
        <input class="form-control" type="text" id="identifiant" name="identifiant" placeholder="Entre ton email ou ton pseudo">
    </div>

    <div class="form-group mt-3">
        <label for="password">Mot de passe</label>
        <input class="form-control" type="password" id="password" name="password" placeholder="Ecris ton mot de passe">
        <a href="reset.php" title="Reinitialise ton mot de passe si tu l'a oublié">Mot de passe oublié</a>
    </div>

    <input type="submit" value="Me connecter" class="btn btn-primary mt-3">
</form>

<?php require_once("inc/footer.php"); ?>