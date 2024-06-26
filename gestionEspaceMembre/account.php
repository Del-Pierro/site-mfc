<?php 
    session_start();
    require_once("inc/function.php"); 
    logged_only();
    require_once("inc/begin.php"); 
?>

<h1>Votre compte</h1>
<?php

debug($_SESSION);

?>
<?php require_once("inc/footer.php"); ?>