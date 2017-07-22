<?php
$login = $_GET["login"];
$flatNum = $_GET['flat'];

require $_SERVER['DOCUMENT_ROOT'].'/toolbox/dbLogIn.php';
require $_SERVER['DOCUMENT_ROOT'].'/toolbox/isAuth.php';

$str = "";

$query = 'SELECT * FROM Owner WHERE login="'.$login.'"';
$r = $bdd->query($query)->fetch();
for($i = 1; $i<sizeOf($r)/2 -2;$i++){
  $str .= $r[$i]."|";
}


$query = 'SELECT t.* FROM Transaction t, Rental r WHERE
        r.flatID="'.$flatNum.'"
        AND t.rentalID = r.id
        AND t.transactionDate >= "'.$_GET["dateStart"].'"
        AND t.transactionDate <= "'.$_GET["dateEnd"].'"
        ORDER BY transactionDate';

// echo $query;
$r = $bdd->query($query);
$i = 0;
$str2 = "";
while($t = $r->fetch()){
  $i++;
  $str2 .= $t['transactionDate']."|".$t['title']."|".$t['amount']."|";
}

echo $str.$i."|".$str2;

// for($i = 1; $i<3;$i++){
//   echo $r[$i];
//   echo "|";
// }

?>
