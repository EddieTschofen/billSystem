<?php
//isOwner : check if the user is the owner of the appartment
// session_start();
//check if connected
$flat = $bdd->query('SELECT * FROM Flat where id="'.$flatNum.'" and ownerID="'.$_SESSION['user'].'"');
$flatInfo;
$redirect;
if($flatInfo = $flat->fetch()){
  // var_dump($flatInfo);
  $redirect = 0;
}
else{
  //redirect
  $redirect = 1;
  header('Location: /');
}
?>
