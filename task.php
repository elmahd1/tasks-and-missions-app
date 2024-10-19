<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gestion des taches</title>
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
    <h3> Créer une tâche :</h3><br>
   <input type='text' placeholder='Nom de la tâche' name='nom' required><br>
   <input type='text' placeholder='Description' name='description' required><br>
   <input type='number' placeholder='Priorité' name='priorite' required><br>
   <input type="hidden" name="tache" value="creertache">
   <input type="hidden" name="resultat" value="">
   <input type="text" placeholder="status" name="status" required>
   <button type='submit'>Créer la tâche</button>
   </form>
  <?php
   
    $sql = "SELECT * FROM tasks WHERE user_id = '$user_id'
    order by priorites";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h3>Vos tâches :</h3>";
        foreach ($result as $data) {
            echo"<form action='register.php' method='post'>
           <input type='hidden' value='$data[id]' name='id'>
            <input type='text' value='$data[nom]' name='nom' >
        <input type='text' value='$data[description]' name='description' >
        <input type='number' value='$data[priorites]' name='priorite' placeholder='priorite' >
        <input type='text' value='$data[resultat]' name='resultat' placeholder='resultat'>
        <input type='hidden' value='tache' name='tache'>
        <input type='text' value='$data[status]' name='status' placeholder='status'>
        <button type='submit'>modifier</button>
        </form>  
        <form action='register.php' method='post'>
        <input type='hidden' name='sup_id' value='$data[id]'>
        <button type='submit'>suprimer</button></form> ";
//link a task        
        $sm="SELECT * from missions";
        $resultm=$conn->query($sm);
        echo"<form action='linkTaskToMission.php' method='post'>";
        echo"<input type='hidden' value='$data[id]' name='task_id'>";
        echo"<select name='mission_id'>";
        foreach($resultm as $data2){
        echo"<option value='$data2[id]'>$data2[nom]</option>";
        }
        echo"</select>";
        echo"<button type='submit'>link</button>";
        echo"</form>";
//share a task
        $sm="SELECT * from users";
        $resultm=$conn->query($sm);
        echo"<form action='register.php' method='post'>";
        echo"<input type='hidden' value='$data[id]' name='task_id'>";
        echo"<input type='hidden' value='nice' name='sharetask'>";
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
        echo"   <h3>~~~~~~~~</h3> ";
    }
    } else {
        echo "Aucune tâche trouvée.";
    }
    $sql=" SELECT 
    shared_tasks.user_partage_id,
    shared_tasks.droit,
    tasks.id ,
    tasks.nom ,
    tasks.description ,
    tasks.resultat ,
    tasks.priorites ,
    tasks.status 
FROM 
    shared_tasks
INNER JOIN 
    tasks ON shared_tasks.task_id = tasks.id
WHERE 
    shared_tasks.user_partage_id = $_SESSION[user_id];  -- Replace ? with the specific user ID if needed
";
    $result=$conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<h3>Les tâches que vous avez recus:</h3>";
        while ($row = $result->fetch_assoc()) {
            if ($row['droit'] == 'modification') {
                echo "<form action='register.php' method='post'>
                        <input type='hidden' value='{$row['task_id']}' name='id'>
                        <input type='text' value='{$row['nom']}' name='nom'>
                        <input type='text' value='{$row['description']}' name='description'>
                        <input type='number' value='{$row['priorites']}' name='priorite' placeholder='Priorité'>
                        <input type='text' value='{$row['resultat']}' name='resultat' placeholder='Résultat'>
                        <input type='hidden' value='tache' name='tache'>
                        <input type='text' value='{$row['status']}' name='status' placeholder='Statut'>
                        <button type='submit'>Modifier</button>
                     </form>
                     <form action='register.php' method='post'>
                        <input type='hidden' name='sup_id' value='{$row['task_id']}'>
                        <button type='submit'>Supprimer</button>
                     </form>";
            } else {
                echo "<input type='text' value='{$row['nom']}' name='nom' readonly>
                      <input type='text' value='{$row['description']}' name='description' readonly>
                      <input type='number' value='{$row['priorites']}' name='priorite' placeholder='Priorité' readonly>
                      <input type='text' value='{$row['resultat']}' name='resultat' placeholder='Résultat' readonly>
                      <input type='text' value='{$row['status']}' name='status' placeholder='Statut' readonly><br>";
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