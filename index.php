<?php 

require 'conndb.php';
require 'menu.php';

if(isset($_POST["login"])){

    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $password = $_POST["mot_de_passe"];
    $token=$_POST["token"];

    $sql="SELECT creationtime from tokens where token ='$token'";
    $result=$conn->query($sql);
    //verification ai 1o mins ont passes token pour refuser la connection 
    if($result->num_rows>0){
    while($row=$result->fetch_assoc())
    $tokendate=$row['creationtime'];
    $tokendate = new DateTime($tokendate);
    $current_time = new DateTime();
    $interval = $current_time->diff($tokendate);
    $minutes_passed = $interval->i;
    if($minutes_passed >= 10){
        header("location:login.php");
    }}
    else{
    //si le token nest pas correcte nexiste pas dans la db
    header("location:login.php");}
    
    $sql="SELECT * FROM users where nom='$nom'";
    $result=$conn->query($sql);

    if($result->num_rows>0){
       while( $row = $result->fetch_assoc()){
        $hp = $row['motde_passe'];     
        if (password_verify($password, $hp)) {
            session_start();
            $_SESSION['username'] = $nom;
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_droit'] = $row['droit'];
            $_SESSION['user_etat']=$row['etat'];
            
        } 
            else{
                header("location:login.php");
            }}
        }else{
             // CREATE ACC
    $hp = password_hash($password, PASSWORD_BCRYPT);

    

    $sql = $conn->prepare("INSERT INTO users( nom, droit, etat, email, motde_passe) VALUES (?, ?, 'user', 'desactive', ?, ?)");
    $sql->bind_param("isss", $nom, $email, $hp);

    if ($sql->execute()) {
        $operation="INSERT INTO operations(user_id, operation, dateheur) VALUES ('0','$nom a creer un compte',NOW())";
    $resop=$conn->query($operation);
        header("Location: login.php");  // Redirect login page after acc creation
        exit();
    } else {
        echo "Error creating account.";
    }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

 </head>
<body>
    <a href="login.php">creer/connecter a votre compte</a><br>
    <a href="logout.php">Déconnexion</a><br>
    <a href="user.php">votre compte</a><br>
</body>
</html>

<?php 




if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
   
    $nom = $_SESSION['username'];
        $etat = $_SESSION['user_etat'];
        $droit = $_SESSION['user_droit'];

if($etat=='desactive'){
    echo"veuiller patienter jusqu'a l'activation de votre compte par l'admin pour avoit les autres fonctionalitees";
}
else{
    echo"<a href='task.php'>gestion des taches</a><br>";
    echo"<a href='mission.php'>gestion des missions</a><br>";
    if($droit=='admin')
    echo"<a href='operation.php'>operations</a><br>";
}
}