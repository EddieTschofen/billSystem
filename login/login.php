<?php

  // var_dump($_POST);
  require $_SERVER['DOCUMENT_ROOT'].'/toolbox/dbLogIn.php';
  $username = $_POST['username'];
  $password = md5($_POST['password']);
  // echo $username . " " . $password . "<br/>";

  $log = $bdd->query('SELECT * FROM Users where login="'.$username.'" and password="'.$password.'"')->fetch();
  if($log){
    session_start();
    $_SESSION['user'] = $log['id'];
    $_SESSION['key'] = rand_char(10);
    if($bdd->query('SELECT * FROM Sessions where userID="'.$log['id'].'"')->fetch()){
      $bdd->query('DELETE FROM Sessions WHERE userID="'.$log['id'].'"')->fetch();
    }
    $bdd->query('INSERT INTO Sessions (sessNumber,userID) VALUES ("'.$_SESSION['key'].'","'.$_SESSION['user'].'")')->fetch();
    header('Location: /');
  }
  else{
    header('Location: /login/');
  }

  function rand_char($length) {
    $random = '';
    for ($i = 0; $i < $length; $i++) {
      $random .= chr(mt_rand(33, 126));
    }
    return $random;
  }
?>
