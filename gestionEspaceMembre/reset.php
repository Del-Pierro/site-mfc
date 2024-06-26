<?php

if(!empty($_POST) && !empty($_POST["email"])){
    require_once("inc/db.php");

    $req = $pdo->prepare("SELECT * FROM espacemembre WHERE email=?");
    $req->execute([$_POST["email"]]);

    $user = $req->fetch();

    session_start();
    if(isset($user) && !empty($user)){
        $_SESSION["user"] = $user;
        $_SESSION["flash"]["success"] = "valide les champs suivants pour reinitialiser ton compte";
        header("Location: newlogin.php");
        die();
    }
}

?>
<?php require_once "inc/begin.php"; ?>

<h1>Confirmation d'email</h1>
<form action="" method="POST">
    <div class="form-group mb-3">
            <label for="email">Email</label>
            <input class="form-control" type="text" id="email" name="email" placeholder="Entre ton email pour reinitialiser ton compte">
    </div>

    <input type="submit" value="confirme ton email" class="btn btn-primary mt-3">
</form>

<?php require_once "inc/footer.php" ?>