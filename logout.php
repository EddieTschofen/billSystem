<?php
  //Logout
  session_start();
  unset($_SESSION["user"]);
  unset($_SESSION["key"]);

  echo 'You have cleaned session';
  header('Refresh: 1; URL = /');
?>
