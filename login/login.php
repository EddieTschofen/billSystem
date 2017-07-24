<?php
  require $_SERVER['DOCUMENT_ROOT'].'/toolbox/rand_char.php';
  //log in database
  require $_SERVER['DOCUMENT_ROOT'].'/toolbox/dbLogIn.php';
  //get POST var
  $username = $_POST['username'];
  $password = md5($_POST['password']);
  //log: check username and password
  $log = $bdd->query('SELECT * FROM Owner where login="'.$username.'" and password="'.$password.'"')->fetch();
  // if successfully loged
  if($log){
    //create session vars
    session_start();
    $_SESSION['user'] = $log['id'];
    $_SESSION['key'] = rand_char(10);
    //remove session if exists
    if($bdd->query('SELECT * FROM Sessions where userID="'.$log['id'].'"')->fetch()){
      $bdd->query('DELETE FROM Sessions WHERE userID="'.$log['id'].'"')->fetch();
    }
    // create session in database
    $bdd->query('INSERT INTO Sessions (sessNumber,userID) VALUES ("'.$_SESSION['key'].'","'.$_SESSION['user'].'")')->fetch();
    // create cookie
    setcookie("billUser",$_SESSION['user'],time()+60*60*24*7,'/');
    setcookie("billKey",$_SESSION['key'],time()+60*60*24*7,'/');
    //redirect
    header('Location: /');
  }
  else{
    // if unsuccessfully loged redirect to login page
    header('Location: /login/');
  }


?>
