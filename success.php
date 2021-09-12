<?php
session_start();
require('page_class.php');
$studPort = new Stud_portal;
$con_stat  = $studPort->selectInfo($_SESSION['user_id']);

// Check if user is has ID of 45 
if($_SESSION['user_id'] >= 49){
$userstat = "Registered late";
}else{
$userstat = "Registered early";
}

if($con_stat==3){
header("location:admin");
}else if($con_stat==1){
header("location:student");
}else{
header("location:staff");	
}
?>
