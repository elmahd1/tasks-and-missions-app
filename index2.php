<?php 
require 'conndb.php';

function caracterverify($var){

    $message='';
    $specialchars ='!?/\;."';
    $varl=strlen($var);
    $sc=strlen($specialchars);

    for($i=0;$i<$specialchars;$i++){
        for($j=0;$j<$varl;$j++){
            if($var[$j]==$specialchars[$i]){
                $message+='contains the special';
            }
        }
    }
}

if(isset($_POST["login"])){
?>

<?php
    $user=$_POST["nom"];
caracterverify($user);
if(isset($message)){
    die("$message");
}
}
?>