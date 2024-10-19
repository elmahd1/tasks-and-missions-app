<?php 
session_start();
require 'conndb.php';
$user_id=$_SESSION['user_id'];
if(isset($_POST["tache"])){
$nom=$_POST["nom"];
$description=$_POST["description"];
$priorite=$_POST["priorite"];
$resultat=$_POST["resultat"];
$status=$_POST["status"];
    if(isset($_POST["id"])){
        $id=$_POST["id"];
        $sql="UPDATE `tasks` SET `nom`='$nom',`description`='$description',`resultat`='$resultat',`priorites`='$priorite',`status`='$status' WHERE `id`='$id'";
    $result=$conn->query($sql);
        if($conn->query($sql)===true){
            $operation="INSERT INTO `operations`(`user_id`, `operation`, `dateheur`) VALUES ('$_SESSION[user_id]','$session[username] a mis a jour la tache $nom',NOW())";
            $resop=$conn->query($operation);
            header("location:task.php");
        }
    }
    else{
        if(isset($_POST["mission_id"])){
            $mission_id=$_POST["mission_id"];
            $sql="INSERT INTO `tasks`(`nom`, `description`, `resultat`, `priorites`, `status`, `user_id`, `missions_id`) VALUES ('$nom','$description','$resultat','$priorite','$status','$user_id','$mission_id')";}
        else{
            $sql="INSERT INTO `tasks`(`nom`, `description`, `priorites`, `resultat`, `status`, `user_id`)                VALUES ('$nom','$description','$priorite','$resultat','$status','$user_id')";
        }
 if($conn->query($sql)===true){
    $operation="INSERT INTO `operations`(`user_id`, `operation`, `dateheur`) VALUES ('$_SESSION[user_id]','$session[username] a insere la tache $nom',NOW())";
    $resop=$conn->query($operation);
    header("location:task.php");
}}
}

    if(isset($_POST["acctoactivate"])){


$nom = $_POST["acctoactivate"];

// Utiliser une requête préparée pour éviter les injections SQL
$sql = "UPDATE users SET etat='active' WHERE nom = '$nom'";
$result=$conn->query($sql);

// Exécuter la requête et vérifier si elle a réussi
if ($conn->query($sql)) {
    $operation="INSERT INTO `operations`(`user_id`, `operation`, `dateheur`) VALUES ('$_SESSION[user_id]','$_SESSION[username] a active lutilisateur $nom',NOW())";
    $resop=$conn->query($operation);
    // Rediriger vers la page user.php si l'activation a réussi
    header("Location: user.php");
    exit();
} else {
    echo "Erreur lors de l'activation du compte.";
}
}


if(isset($_POST["mission"])){
$user_id=$_SESSION['user_id'];
$nom=$_POST["nom"];
$description=$_POST["description"];
    if(isset($_POST["id"])){
        $id=$_POST["id"];
        $sql="UPDATE `missions` SET `nom`='$nom',`description`='$description' WHERE `id`='$id'";
    $result=$conn->query($sql);
        if($conn->query($sql)===true){
            $operation="INSERT INTO `operations`(`user_id`, `operation`, `dateheur`) VALUES ('$_SESSION[user_id]','$session[username] a mis a jour la mission $nom',NOW())";
            $resop=$conn->query($operation);
            header("location:mission.php");
        }
    }
    else{
 $sql="INSERT INTO `missions`(`nom`, `description`, `user_id`) VALUES ('$nom','$description','$user_id')";
if($conn->query($sql)===true){
    $operation="INSERT INTO `operations`(`user_id`, `operation`, `dateheur`) VALUES ('$_SESSION[user_id]','$session[username] a insere la mission $nom',NOW())";
    $resop=$conn->query($operation);
    header("location:mission.php");
}}
}
if(isset($_POST["sup_id"])){
    $sup_id=$_POST["sup_id"];
    $sql="DELETE from tasks where id=$sup_id";
$result=$conn->query($sql);
if($conn->query($sql)==true){
    $operation="INSERT INTO `operations`(`user_id`, `operation`, `dateheur`) VALUES ('$_SESSION[user_id]','$session[username] a suprime une tache',NOW())";
    $resop=$conn->query($operation);
header("location:task.php");}
}
if(isset($_POST["sharetask"])){
    $user_id=$_POST["user"];
    $task_id=$_POST["task_id"];
    $droit=$_POST["droit"];
$sql="INSERT INTO `shared_tasks`(`task_id`, `user_partage_id`, `droit`) VALUES ('$task_id','$user_id','$droit') ";
$result=$conn->query($sql);
if($conn->query($sql)===true){
    $operation="INSERT INTO `operations`(`user_id`, `operation`, `dateheur`) VALUES ('$_SESSION[user_id]','$session[username] a partage la tache $task_id vers $user_id',NOW())";
    $resop=$conn->query($operation);
    header("location:task.php");
}
}
if(isset($_POST["sharemission"])){
    $user_id=$_POST["user"];
    $mission_id=$_POST["mission_id"];
    $droit=$_POST["droit"];
$sql="INSERT INTO `shared_mission`(`mission_id`, `user_partage_id`, `droit`) VALUES ('$mission_id','$user_id','$droit') ";
$result=$conn->query($sql);
if($conn->query($sql)===true){
    $operation="INSERT INTO `operations`(`user_id`, `operation`, `dateheur`) VALUES ('$_SESSION[user_id]','$session[username] a partage la mission $mission_id vers $user_id',NOW())";
    $resop=$conn->query($operation);
header("location:mission.php");}
}
$conn->close();
?>
