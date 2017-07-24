<?php
  require $_SERVER['DOCUMENT_ROOT'].'/toolbox/dbLogIn.php';
  //Logout
  session_start();
  if($_SESSION["user"] != ""){
    $query = 'DELETE FROM Sessions WHERE userID="'.$_SESSION['user'].'"';
    echo $query;
    $bdd->query($query);
  }
  unset($_SESSION["user"]);
  unset($_SESSION["key"]);
  unset($_COOKIE["billUser"]);
  unset($_COOKIE["billKey"]);

  echo 'You have cleaned session';
  header('Location: /login/');
?>
