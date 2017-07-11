<?php
session_start();

require $_SERVER['DOCUMENT_ROOT'].'/toolbox/dbLogIn.php';
require $_SERVER['DOCUMENT_ROOT'].'/toolbox/isAuth.php';

$correctPass = $bdd->query('SELECT * FROM Owner WHERE password="'.md5($_POST['ownerOldPassword']).'" AND id="'.$_SESSION['user'].'"');
$rep = $correctPass->fetch();
if($rep){
  if($_POST['ownerNewPassword'] === $_POST['ownerNewPasswordConfirmation']){
    $bdd->query('UPDATE Owner SET password="'.md5($_POST['ownerNewPassword']).'" WHERE id="'.$_SESSION['user'].'"');
    header('Location: /profil/editPassword?m=cmdp');
  }
  else{
    header('Location: /profil/editPassword?m=nmdp');
  }
}
else{
  header('Location: /profil/editPassword?m=omdp');
}


?>
