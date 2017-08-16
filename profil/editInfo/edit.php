<?php
session_start();

require $_SERVER['DOCUMENT_ROOT'].'/toolbox/dbLogIn.php';
require $_SERVER['DOCUMENT_ROOT'].'/toolbox/isAuth.php';

// var_dump($_POST);

$correctPass = $bdd->query('SELECT * FROM Owner WHERE password="'.md5($_POST['ownerPassword']).'" AND id="'.$_SESSION['user'].'"');
$rep = $correctPass->fetch();
//check if right password
if($rep){
  //update database
  $query = 'UPDATE Owner SET name="'.$_POST['ownerName'].'",
                                address="'.$_POST['ownerAddress'].'",
                                zip="'.$_POST['ownerZip'].'",
                                city="'.$_POST['ownerCity'].'",
                                email="'.$_POST['ownerMail'].'",
                                phone="'.$_POST['ownerPhone'].'",
                                cell="'.$_POST['ownerCell'].'",
                                bankName="'.$_POST['bankName'].'",
                                IBAN="'.$_POST['ownerIBAN'].'",
                                BIC="'.$_POST['ownerBIC'].'"
                                WHERE id="'.$_SESSION['user'].'"';
  $bdd->query($query);
  header('Location: /profil/?m=ok');
}
else{
  header('Location: /profil/editInfo?m=mdp');
}


?>
