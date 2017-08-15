<?php
$billNum = $_GET['id'];

require $_SERVER['DOCUMENT_ROOT'].'/toolbox/dbLogIn.php';
require $_SERVER['DOCUMENT_ROOT'].'/toolbox/isAuth.php';

$query = 'DELETE FROM Bill WHERE id="'.$billNum.'"';
$q = $bdd->exec($query);
?>
