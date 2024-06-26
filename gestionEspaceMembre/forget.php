<?php

if(!empty($_POST) && !empty($_POST["email"])){
    require_once("inc/db.php");
    require_once("inc/function.php");

    $req = $pdo->prepare("SELECT * FROM espacemembre WHERE email=?");
    $req->execute([$_POST["email"]]);

    $user = $req->fetch();

    session_start();
    if($user){
        $reset_token = str_random(60);
        $user_id = $user["id"];
        $pdo->prepare("UPDATE espacemembre SET reset_token=?, reset_at=NOW() WHERE id=?")->execute([$reset_token, $user["id"]]);
        mail($_POST["email"], "Réinitialisation de votre mot de passe", "Afin de réinitialiser votre mot de passe, merci de cliquer sur ce lien :\n\nhttp://localhost/gestionEspaceMembre/reset.php?id=$user_id&token=$reset_token");
        $_SESSION["flash"]["success"] = "Les instructions du rappel de mot de passe vous ont été envoyé par email";
        header("Location: login.php");
        exit();
    }else{
        $_SESSION["flash"]["danger"] = "Aucun compte ne correspond = cet adresse";
    }
}

?>
<?php require_once "inc/begin.php"; ?>

<h1>Mot de passe oublié</h1>
<form action="" method="POST">
    <div class="form-group mb-3">
            <label for="email">Email</label>
            <input class="form-control" type="email" id="email" name="email" placeholder="Entre ton email pour reinitialiser ton compte">
    </div>

    <input type="submit" value="confirme ton email" class="btn btn-primary mt-3">
</form>

<?php require_once "inc/footer.php" ?>