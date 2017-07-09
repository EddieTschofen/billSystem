<?php
require $_SERVER['DOCUMENT_ROOT'].'/toolbox/rand_char.php';
session_start();

// echo $_SESSION['user'] . "   -   " . $_SESSION['key'] . "<br/>";

// echo 'SELECT * FROM Sessions where userID="'.$_SESSION['user'].'" and sessNumber="'.$_SESSION['key'].'"';

$loged = $bdd->query('SELECT * FROM Sessions where userID="'.$_SESSION['user'].'" and sessNumber="'.$_SESSION['key'].'"');
if($loged->fetch()){
  $_SESSION['key'] = rand_char(10);
  $bdd->query('UPDATE Sessions SET sessNumber="'.$_SESSION['key'].'" WHERE userID="'.$_SESSION['user'].'"')->fetch();
}
else{
  header('Location: /login/');
}


?>
