<?php
session_start();
require_once("inc/function.php");

if(!empty($_POST)){
    require_once("inc/db.php");
    $errors = [];

    if(empty($_POST["pseudo"]) || !preg_match('/^[a-z0-9A-Z]+$/',$_POST["pseudo"])){
        $errors["pseudo"] = "Ton pseudo n'est pas valide";
    }else{
        $req = $pdo->prepare("SELECT id FROM espacemembre WHERE pseudo=?");
        $req->execute([$_POST["pseudo"]]);
        $user = $req->fetch();

        if($user){
            $errors["pseudo"] = "Ce pseudo est déjà pris";
        }
    }
    
    if(empty($_POST["email"]) || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
        $errors["email"] = "Ton email n'est pas valide";
    }else{
        $req = $pdo->prepare("SELECT id FROM espacemembre WHERE email=?");
        $req->execute([$_POST["email"]]);
        $user = $req->fetch();
    
        if($user){
            $errors["email"] = "Cet email est déjà utilisé pour un autre compte";
        }
    }

    if(empty($_POST["password"]) || $_POST["password"] != $_POST["confirmPassword"] || strlen($_POST["password"]) < 8){
        $errors["password"] = "Ton mot de passe n'est pas valide...il doit faire au moins 8 caractères";
    }


    if(empty($errors)){
        
        $req = $pdo->prepare("INSERT INTO espacemembre SET pseudo=?, email=?, password=?,confirmation_token=?");
        $password = password_hash($_POST["password"],PASSWORD_BCRYPT);
        $token = str_random(60);
        $req->execute([$_POST["pseudo"], $_POST["email"], $password, $token]);
        $user_id = $pdo->lastInsertId();
        mail($_POST["email"], "Confirmation de compte", "Afin de valider ton compte, merci de cliquer sur ce lien :\n\nhttp://localhost/gestionEspaceMembre/confirm.php?id=$user_id&token=$token");

        $_SESSION["flash"]["success"] = "Un email de validation a été envoyé pour valider ton compte";
        header("Location: login.php");
        exit();
    }

}

?>

<?php require("inc/begin.php"); ?>
<h1>S'inscrire</h1>

<?php if(!empty($errors)) : ?>
    <div class="alert alert-danger">
        <p>Vous n'avez pas correctement remplit le formulaire</p>
        <ul>
            <?php foreach($errors as $error) : ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="" method="POST">
    <div class="form-group mb-3">
        <label for="pseudo">Pseudo</label>
        <input type="text" class="form-control" placeholder="Entre ton pseudo" id="pseudo" name="pseudo">
    </div>

    <div class="form-group mb-3">
        <label for="email">Email</label>
        <input type="text" class="form-control" placeholder="Donne ton email, stp " id="email" name="email">
    </div>

    <div class="form-group mb-3">
        <label for="password">Mot de passe</label>
        <input type="password" class="form-control" placeholder="Ton mot de passe" id="password" name="password">
        <p style="font-style:italic; color:red;" title="prend soin d'entrer plus de caractère">ton mot de passe doit avoir un minimum de 8 caractère</p>
    </div>

    <div class="form-group mb-3">
        <label for="confirmPassword">Confirme ton mot de passe</label>
        <input type="password" class="form-control" placeholder="Confirmation du passe" id="confirmPassword" name="confirmPassword">
    </div>

    <input type="submit" value="M'inscrire" class="btn btn-primary">
</form>

<?php require("inc/footer.php"); ?>
