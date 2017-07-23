<?php
$flatNum=$_GET['flat'];

require $_SERVER['DOCUMENT_ROOT'].'/toolbox/dbLogIn.php';
require $_SERVER['DOCUMENT_ROOT'].'/toolbox/isAuth.php';
require $_SERVER['DOCUMENT_ROOT'].'/toolbox/isOwner.php';
// // $redirect = 1;
if(!$redirect){
  $rentalID = $bdd->query('SELECT * FROM Rental WHERE flatID="'.$flatNum.'"')->fetch()['id'];
  $title=$_GET['title'];
  $date=implode('-', array_reverse(explode('/', $_GET['date'])));
  $amount=$_GET['amount'];

  $r = $bdd->exec('INSERT INTO Transaction (title,rentalID,transactionDate,amount) VALUES ("'.$title.'",'.$rentalID.',"'.$date.'",'.$amount.')');
  echo 1;
}
else{
  echo 0;
}
?>
