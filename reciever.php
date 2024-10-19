<?php 
// Récupérer la réponse JSON d'une API 
$response = file_get_contents('C:\xampp\htdocs\gestion de missions et taches\api.php'); 
// Convertir la réponse JSON en tableau PHP 
$data = json_decode($response, true); // true pour convertir en tableau associatif 
// Afficher les données 
print_r($data); 
?>