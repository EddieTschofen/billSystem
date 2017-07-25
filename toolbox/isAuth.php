<?php
//isAuth : check if the user is connected, if not, redirect to login page
require $_SERVER['DOCUMENT_ROOT'].'/toolbox/rand_char.php';
session_start();

// if no session var then check cookie
if($_SESSION['user'] == "" && $_SESSION['key'] == ""){
  $_SESSION['user'] = $_COOKIE['billUser'];
  $_SESSION['key'] = $_COOKIE['billKey'];
}
//check if connected
$loged = $bdd->query('SELECT * FROM Session where userID="'.$_SESSION['user'].'" and sessNumber="'.$_SESSION['key'].'"');
//if connected
if($loged->fetch()){
  //change session key
  $_SESSION['key'] = rand_char(10);
  //update it in database
  $bdd->query('UPDATE Session SET sessNumber="'.$_SESSION['key'].'" WHERE userID="'.$_SESSION['user'].'"')->fetch();
  // create cookie
  setcookie("billUser",$_SESSION['user'],time()+60*60*24*7,'/');
  setcookie("billKey",$_SESSION['key'],time()+60*60*24*7,'/');
}
else{
  //redirect
  header('Location: /login/');
}
?>
