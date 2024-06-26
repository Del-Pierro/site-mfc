<?php 
    
    require_once("inc/function.php"); 
    logged_only();
    require_once("inc/begin.php"); 
?>
<?php
if(!empty($_POST)){
    require_once("inc/db.php");
    

    if(!empty($_POST["password"]) && $_POST["password"] == $_POST["confirmPassword"] && strlen($_POST["password"]) < 8){
        $req = $pdo->prepare("UPDATE espacemembre SET password=? WHERE email=?");
        $req->execute([$_POST["password"],$_SESSION["user"]->email]);
        session_start();
        $_SESSION["flash"]["success"] = "Votre compte a bien été reinitialisé";
        header("Location: account.php");
        exit();

    }else{
        $errors["password"] = "Ton mot de passe n'est pas valide...il doit faire au moins 8 caractères";
    }


}

?>
<h1>Reinitialisation du mot de passe</h1>
<form action="" method="post">
    <div class="form-group mt-3">
        <label for="password">Nouveau mot de passe </label>
        <input class="form-control" type="password" id="password" name="password" placeholder="un mot de passe different du précédant">
    </div>

    <div class="form-group mt-3">
        <label for="passwordConfirm">Confirmer le Mot de passe</label>
        <input class="form-control" type="password" id="passwordConfirm" name="passwordConfirm" placeholder="confirme ton nouveau passe">
    </div>

    <input type="submit" value="Reinitialiser mon mot de passe" class="btn btn-primary mt-3">
</form>

<?php require_once("inc/footer.php"); ?>