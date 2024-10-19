<?php 
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
   
    $nom = $_SESSION['username'];
        $etat = $_SESSION['user_etat'];
        $droit = $_SESSION['user_droit'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>menu</title>
  </head>
<body>
    <button><a href="login.php">login/creation de compte</a></button>
    <button><a href="logout.php">deconnecter</a></button>
    <button><a href="user.php">votre compte</a></button>
    <?php 
    if($etat=='active'){
    ?>
    <button><a href="task.php">gestion des taches</a></button>
    <button><a href="mission.php">gestion des missions</a></button>
    <?php }
    if($droit=='admin'){?>
    <button><a href="operation.php">operation</a></button>
    <?php
} ?>
</body>
</html>

<?php 
}
?>
<script></script>