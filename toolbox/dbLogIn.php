<?php
//connect to database
if($_SERVER['HTTP_HOST'] == "localhost"){
  $host_name = "localhost";$database = "billSystem";$user_name = "billSystemUser";$password = 'billSystemPassword';
}
else{
  $host_name = "db692906303.db.1and1.com";$database = "db692906303";$user_name = "dbo692906303";$password = 'Eddie38640';
}

try{
	$bdd = new PDO('mysql:host='.$host_name.';dbname='.$database.';charset=utf8', $user_name, $password);
} catch (Exception $e) {
    echo 'Exception reçue : ',  $e->getMessage(), "\n";
}
?>
