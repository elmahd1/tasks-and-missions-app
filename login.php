<?php 
require 'conndb.php';
require 'functions.php';
$token=token();
$sql="INSERT INTO `tokens`( `token`, `creationtime`) VALUES ('$token',NOW())";
$result=$conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <form action="index.php" method="post">
<input type="text" name="nom" required>
<?PHP echo"<input type='hidden' name='token' value='$token'>" ?>
<input type="email" name="email" required>
<input type="password" name="mot_de_passe" required>
<input type="hidden" name="login" value="test">
<button type="submit">envoyer</button>
    </form>
</body>
</html>
