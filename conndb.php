<?php 
$server = "localhost";
$user = "root";
$password = "";
$db = "tp0";

$conn = new mysqli($server, $user, $password, $db);

if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}
?>