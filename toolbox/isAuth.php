<?php
//isAuth : check if the user is connected, if not, redirect to login page
require $_SERVER['DOCUMENT_ROOT'].'/toolbox/rand_char.php';
session_start();
//check if connected
$loged = $bdd->query('SELECT * FROM Sessions where userID="'.$_SESSION['user'].'" and sessNumber="'.$_SESSION['key'].'"');
//if connected
if($loged->fetch()){
  //change session key
  $_SESSION['key'] = rand_char(10);
  //update it in database
  $bdd->query('UPDATE Sessions SET sessNumber="'.$_SESSION['key'].'" WHERE userID="'.$_SESSION['user'].'"')->fetch();
}
else{

  //redirect
  header('Location: /toolbox/logout.php');
}
?>
