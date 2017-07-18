<?php
$transactionNum = $_GET['id'];
$flatNum=$_GET['flat'];
require $_SERVER['DOCUMENT_ROOT'].'/toolbox/dbLogIn.php';
require $_SERVER['DOCUMENT_ROOT'].'/toolbox/isAuth.php';
require $_SERVER['DOCUMENT_ROOT'].'/toolbox/isOwner.php';
// $redirect = 1;
if(!$redirect){
  $q = $bdd->exec('DELETE FROM Transaction WHERE id="'.$transactionNum.'"');
  echo $q;
}
else{
  echo 0;
}
?>
