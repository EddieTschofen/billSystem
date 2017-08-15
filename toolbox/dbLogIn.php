<?php
//connect to database
// $bdd = new PDO('mysql:host=localhost;dbname=billSystem;charset=utf8', 'billSystemUser', 'billSystemPassword');

// $host_name = "localhost";$database = "billSystem";$user_name = "billSystemUser";$password = 'billSystemPassword';
$host_name = "db692906303.db.1and1.com";$database = "db692906303";$user_name = "dbo692906303";$password = 'Eddie38640';
$bdd = new PDO('mysql:host='.$host_name.';dbname='.$database.';charset=utf8', $user_name, $password);


// $connect = mysqli_connect($host_name, $user_name, $password, $database);
// if(mysqli_connect_errno())
// {
// echo '<p>La connexion au serveur MySQL a échoué: '.mysqli_connect_error().'</p>';
// }
// else
// {
// echo '<p>Connexion au serveur MySQL établie avec succès.</p>';
// }

 ?>
