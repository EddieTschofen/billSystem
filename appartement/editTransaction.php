<?php
$flatNum=$_GET['flat'];

require $_SERVER['DOCUMENT_ROOT'].'/toolbox/dbLogIn.php';
require $_SERVER['DOCUMENT_ROOT'].'/toolbox/isAuth.php';
require $_SERVER['DOCUMENT_ROOT'].'/toolbox/isOwner.php';
// // $redirect = 1;
if(!$redirect){
  // $rentalID = $bdd->query('SELECT * FROM Rental WHERE flatID="'.$flatNum.'"')->fetch()['id'];
  $transactionID = $_GET['id'];
  $title=$_GET['title'];
  $date=$_GET['date'];
  $amount=$_GET['amount'];
  $query = 'UPDATE Transaction SET title="'.$title.'",transactionDate="'.$date.'",amount="'.$amount.'" WHERE id="'.$transactionID.'"';
  $r = $bdd->exec($query);
  echo 1;
}
else{
  echo 0;
}
?>
