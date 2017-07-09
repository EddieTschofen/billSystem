<?php
$bdd = new PDO('mysql:host=localhost;dbname=billSystem;charset=utf8', 'billSystemUser', 'billSystemPassword');
echo $bdd->query("SELECT * FROM Owner");
 ?>
