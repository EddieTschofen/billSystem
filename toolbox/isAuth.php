<?php
require $_SERVER['DOCUMENT_ROOT'].'/toolbox/rand_char.php';
session_start();

// echo $_SESSION['user']."   -   " . $_SESSION['key'];
$loged = $bdd->query('SELECT * FROM Sessions where userID="'.$_SESSION['user'].'" and sessNumber="'.$_SESSION['key'].'"')->fetch();
if($loged){
//   echo "d";
//   echo $_SERVER['DOCUMENT_ROOT'].'/toolbox/rand_char.php';
//   $_SESSION['key'] = rand_char(10);
//   $bdd->query('UPDATE Sessions SET sessNumber="'.$_SESSION['key'].'" WHERE userID="'.$_SESSION['user'].'"')->fetch();
}
else{
  header('Location: /login/');
}


?>
