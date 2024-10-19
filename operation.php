<?php 
require 'conndb.php';
require 'menu.php';

session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
if($_SESSION['user_droit']=='admin'){
$sql="SELECT users.nom, operations.operation , operations.dateheur
FROM users
INNER JOIN operations ON users.id = operations.user_id;";
$result=$conn->query($sql);
if($result->num_rows>0){
    echo"<h3>les operations faites sont:</h3>";
while($row=$result->fetch_assoc()){
    echo"$row[nom]:$row[operation]<br>efectuee en:$row[dateheur]<br><br>";
}}
else{
    echo"pas d'operation faite pour le moment";
}}}
else {
    header("location:login.php");
}
?>