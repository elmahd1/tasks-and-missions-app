<?php 
require 'conndb.php';

$task_id=$_POST["task_id"];
$mission_id=$_POST["mission_id"];

$sql="UPDATE tasks set `missions_id`='$mission_id' where id='$task_id'";
$result=$conn->query($sql);

if($conn->query($sql)===true){
    header("location:mission.php");
}
?>