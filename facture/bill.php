<?php
require $_SERVER['DOCUMENT_ROOT'].'/toolbox/dbLogIn.php';
require $_SERVER['DOCUMENT_ROOT'].'/toolbox/isAuth.php';

$query = "SELECT * FROM Bill WHERE id='".$_GET['id']."'";
$bill = $bdd->query($query)->fetch();
// var_dump($bill);
$url = "/appartement/bill.php?";
$keys = array_keys($bill);
for($i = 0;$i<sizeof($keys);$i = $i+2){
  if($keys[$i] == transactions){
    // echo "TRANSACTIONS<br/>";
    $transactions = explode("|", $bill[$i/2]);
    for($j = 0;$j<(sizeof($transactions)-1)/3;$j++){
      $url .= "date".$j."=".$transactions[$j*3];
      $url .= "&name".$j."=".$transactions[$j*3+1];
      $url .= "&amount".$j."=".$transactions[$j*3+2]."&";
    }
  }
  else{
    // echo $keys[$i*2].$bill[$i].'<br/>';
    $url .= $keys[$i]."=".urlencode($bill[$i/2])."&";
  }
}
// $url = $_SERVER['DOCUMENT_ROOT'].$url;
echo $url;
header('Location: '.$url);

// require $url;
?>
