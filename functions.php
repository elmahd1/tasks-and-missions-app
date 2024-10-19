<?php 
function token(){
    $char="abcdefjhijklmnopqrstuvwxyz1234567890!~@#$%^&*()";
    $idstart=rand(0,29);
    $idend=rand($idstart,30);
    $token='';
    for($i=$idstart;$i<=$idend;$i++){
        $token.=$char[$i];
    }
    return $token;
}

?>