<?php
/*If already loged redirect to home*/
require $_SERVER['DOCUMENT_ROOT'].'/toolbox/dbLogIn.php';
session_start();

// if no session var then check cookie
// var_dump($_COOKIE);
// echo "<br/>";
// var_dump($_SESSION);
if($_SESSION['user'] == "" && $_SESSION['key'] == ""){
  $_SESSION['user'] = $_COOKIE['billUser'];
  $_SESSION['key'] = $_COOKIE['billKey'];
}

$loged = $bdd->query('SELECT * FROM Session where userID="'.$_SESSION['user'].'" and sessNumber="'.$_SESSION['key'].'"');
if($loged->fetch()){
  header('Location: /');
}
?>

<!DOCTYPE html>
<html>
   <head>
      <?php
        require $_SERVER['DOCUMENT_ROOT'].'/toolbox/header.php';
      ?>
      <title>
         Log in
      </title>
   </head>
   <body>
      <div id='login'>
        <h1 id="loginTitle">Connection au systeme de facturation</h1>
        <form action="login.php" method="post">
          <input class="formInput" type="text" id="username" name="username" value="" placeholder="username"> <br/>
          <input class="formInput" type="password" id="password" name="password" value="" placeholder="password"> <br/>
          <input class="loginButton" type="submit" value="Se connecter">
        </form>
      </div>
  </body>
</html>
