<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>votre compte</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    
</body>
</html>
<?php
require 'conndb.php';
session_start();
require 'menu.php';
// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Utiliser le nom de la session
    $nom = $_SESSION['username'];
        $etat = $_SESSION['user_etat'];
        $email = $_SESSION['user_email'];
        $droit = $_SESSION['user_droit'];

    echo "<h3>Bienvenue, " .htmlspecialchars($nom) . "!</h3><br>";
    echo "<h4>les informations de l'utilisateur:</h4><br>$nom <br>$email><br>";
   

    if ($droit != 'admin') {
        if ($etat == 'active') {
            echo "Votre compte a été activé par l'admin";
        } else {
            echo "Votre compte n'est pas activé par l'admin. Veuillez patienter.";
        }
    } else {
        // Si l'utilisateur est admin, afficher la liste des comptes à activer
        $sql = "SELECT * FROM users WHERE etat = 'desactive'";
        $result = $conn->query($sql);
if($result->num_rows>0){
        echo "<h3>Liste des comptes à activer:</h3><br>";
}
else {
    echo"pas de comptes a activer pour le moments";
}
        // Boucle pour afficher tous les utilisateurs désactivés
        while ($row = $result->fetch_assoc()) {
            $nomd = $row["nom"];
            $emaild = $row["email"];

            echo" <form action='register.php' method='post'>";
            // Afficher le nom, l'email et le formulaire d'activation pour chaque utilisateur
            echo "$nomd - $emaild<br>";

            echo "<input type='hidden' value='$nomd' name='acctoactivate'>";
                  
                  echo" <button type='submit'>activer</button></form><br>";          
        }
         
     
         
          
    }
} else {
    
    header("Location: login.html");
    exit();
}
?>
