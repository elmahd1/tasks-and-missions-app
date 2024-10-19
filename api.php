<?php 
header('Content-Type: application/json'); 
$data = [ 
 "name" => "John Doe", 
 "age" => 30, 
 "email" => "johndoe@example.com" 
]; 
// Convertit le tableau PHP en JSON et l'affiche 
echo json_encode($data); 
?>
