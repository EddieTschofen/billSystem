<?php
session_start();

require $_SERVER['DOCUMENT_ROOT'].'/toolbox/dbLogIn.php';
require $_SERVER['DOCUMENT_ROOT'].'/toolbox/isAuth.php';

var_dump($_POST);

$block = $_POST['block'];
if($_POST['block'] == 'newBlock'){
  $query = "INSERT into Apartment_block (name, address, city, zip) VALUES ('".$_POST['name']."','".$_POST['address']."','".$_POST['city']."','".$_POST['zip']."')";
  echo "<br/>".$query;
  $bdd->query($query)->fetch();


  $block = $bdd->lastInsertId();
}
$query = "INSERT into Flat (blockID,flat_num,ownerID) VALUES ('".$block."','".$_POST['flatNum']."','".$_SESSION['user']."')";
echo "<br/>".$query;
$bdd->query($query)->fetch();
header('Location: /appartement/?flat='.$block = $bdd->lastInsertId());


?>
