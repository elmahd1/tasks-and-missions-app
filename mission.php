<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gestion des missions</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    

<?php 
require 'conndb.php';
session_start();
require 'menu.php';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    
    $nom = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];
?>
    <form action='register.php' method='POST'>
    <h3> Créer une missions :</h3><br>
   <input type='text' placeholder='Nom de la mission' name='nom' required><br>
   <input type='text' placeholder='Description' name='description' required><br>
   <input type="hidden" name="mission" value="missions">
   <button type='submit'>Créer la mission</button>
   </form>
  <?php
   
    $sql = "SELECT * FROM missions WHERE user_id = '$user_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Vos missions :</h2>";
        foreach($result as $data){
            echo"<h2>~~~~~~~~</h2>";
            echo"<form action='register.php' method='post'>
            <input value='$data[id]' type='hidden' name='id' >
            <input value='$data[nom]' type='text' name='nom' placeholder='nom de la mission'>
            <input value='$data[description]' type='text' name='description' palceholder='descriptiom'>
            <input value='mission' type='hidden' name='mission'>
            <button type='submit'>modifier</button></form><br>";
            $sql2 = "SELECT * FROM tasks WHERE missions_id = '$data[id]'
            order by priorites";
            $result2 = $conn->query($sql2);
            if($result2->num_rows>0){
                echo"<h3>les taches de cette missions:</h3>";
        foreach ($result2 as $data2) {
            echo"<form action='register.php' method='post'>
           <input type='hidden' value='$data2[id]' name='id'>
            <input type='text' value='$data2[nom]' name='nom' >
        <input type='text' value='$data2[description]' name='description' >
        <input type='number' value='$data2[priorites]' name='priorite' placeholder='priorite' >
        <input type='text' value='$data2[resultat]' name='resultat' placeholder='resultat'>
        <input type='hidden' value='tache' name='tache'>
        <input type='text' value='$data2[status]' name='status' placeholder='status'>
    <button type='submit'>modifier</button> </form>  
         <form action='register.php' method='post'>
        <input type='hidden' name='sup_id' value='$data2[id]'>
        <button type='submit'>suprimer</button></form>  ";
    }}else{
        echo"<h3>pas de taches associes a cette missions.</h3>";
    }

    //share a mission
   $sm="SELECT * from users";
   $resultm=$conn->query($sm);
   echo"<form action='register.php' method='post'>";
   echo"<input type='hidden' value='$data[id]' name='mission_id'>";
   echo"<input type='hidden' value='nice' name='sharemission'>";
   echo"<select name='user'>";
   foreach($resultm as $data2){
   echo"<option value='$data2[id]'>$data2[nom]</option>";
   }
   echo"</select>";
   echo"<select name='droit'>
   <option value='consultation'>consultation</option>
   <option value='modification'>modification</option>
   </select>";
   echo"<button type='submit'>share</button>";
   echo"</form>";
   //creer une tache inside une mission
    echo"
    <form action='register.php' method='POST'>
    <h3> Créer une tâche pour cette mission:</h3><br>
   <input type='text' placeholder='Nom de la tâche' name='nom' required><br>
   <input type='text' placeholder='Description' name='description' required><br>
   <input type='number' placeholder='Priorité' name='priorite' required><br>
   <input type='hidden' name='tache' value='creertache'>
   <input type='hidden' name='resultat' >
   <input type='text' placeholder='status' name='status' required>
   <input name='mission_id' type='hidden' value='$data[id]'>
   <button type='submit'>Créer la tâche</button>
   </form><br>";

   
   echo"<h2>~~~~~~~~</h2>";
}

    } else {
        echo "Aucune mission trouvée.";
    }
   
    
    $sql="SELECT * FROM shared_mission where user_partage_id='$_SESSION[user_id]'";
    $result=$conn->query($sql);
    if($result->num_rows>0){
        echo"<h3>les missions envoyee a cet utilsateur:</h3>";
        foreach($result as $data){
            if($data['droit']=='modification'){
                echo"<form action='register.php' method='post'>
                <input value='$data[id]' type='hidden' name='id' >
                <input value='$data[nom]' type='text' name='nom' placeholder='nom de la mission'>
                <input value='$data[description]' type='text' name='description' palceholder='descriptiom'>
                <input value='mission' type='hidden' name='mission'>
                <button type='submit'>modifier</button></form><br>";
            //task de la mission
            $sql2 = "SELECT * FROM tasks WHERE missions_id = '$data[id]'
            order by priorites";
            $result2 = $conn->query($sql2);
            if($result2->num_rows>0){
                echo"<h3>les taches de cette missions:</h3>";
        foreach ($result2 as $data2) {
            echo"<form action='register.php' method='post'>
           <input type='hidden' value='$data2[id]' name='id'>
            <input type='text' value='$data2[nom]' name='nom' >
        <input type='text' value='$data2[description]' name='description' >
        <input type='number' value='$data2[priorites]' name='priorite' placeholder='priorite' >
        <input type='text' value='$data2[resultat]' name='resultat' placeholder='resultat'>
        <input type='hidden' value='tache' name='tache'>
        <input type='text' value='$data2[status]' name='status' placeholder='status'>
    <button type='submit'>modifier</button> </form>  
         <form action='register.php' method='post'>
        <input type='hidden' name='sup_id' value='$data2[id]'>
        <button type='submit'>suprimer</button></form>  ";}}
        else{echo"<h3>pas de taches atachees a cette mission</h3>";}
        //fin des tasks de la missions envoyee
        }
        else{
            echo"
            <input type='text' value='$data[nom]' name='nom' readonly>
            <input type='text' value='$data[description]' name='description' readonly>";
         //task de la mission
         $sql2 = "SELECT * FROM tasks WHERE missions_id = '$data[id]'
         order by priorites";
         $result2 = $conn->query($sql2);
         if($result2->num_rows>0){
             echo"<h3>les taches de cette missions:</h3>";
     foreach ($result2 as $data2) {
         echo"<input type='text' value='$data2[nom]' name='nom' readonly>
     <input type='text' value='$data2[description]' name='description' readonly>
     <input type='number' value='$data2[priorites]' name='priorite' placeholder='priorite' readonly>
     <input type='text' value='$data2[resultat]' name='resultat' placeholder='resultat' readonly>
     <input type='text' value='$data2[status]' name='status' placeholder='status readonly'> ";}}
     else{echo"<h3>pas de taches atachees a cette mission</h3>";}
     //fin des tasks de la missions envoyee
        }
    }}
    else {
        echo"<h3>aucune taches envoyee a cette utilisateur</h3>";
    }
} else {
    header("location:login.php");
}

?>
</body>
</html>