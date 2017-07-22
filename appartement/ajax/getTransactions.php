<?php
// getTransactions : generate thhe table of transaction
$flatNum=$_GET['flat'];
require $_SERVER['DOCUMENT_ROOT'].'/toolbox/dbLogIn.php';
require $_SERVER['DOCUMENT_ROOT'].'/toolbox/isAuth.php';
require $_SERVER['DOCUMENT_ROOT'].'/toolbox/isOwner.php';

if(!$redirect){
    // $transactions = $bdd->query('SELECT * FROM Transaction ORDER BY transactionDate');
    $transactions = $bdd->query('SELECT t.* FROM Transaction t, Rental r WHERE r.flatID="'.$flatNum.'" AND t.rentalID = r.id ORDER BY transactionDate');
    $str = "";
    while($t = $transactions->fetch()){
      $str .= "<tr>";
      $str .= "<td class='tdBox'>".$t['transactionDate']."</td>";
      $str .= "<td class='titleBox'>".$t['title']."</td>";
      $str .= "<td class='amountBox'>".$t['amount']."€</td>";
      $str .= "<td class='buttonBox'>";
      $str .= '<button type="button" class="btn btn-default" aria-label="Left Align" onclick="deleteTransaction(\''.$t['id'].'\',\''.$t['transactionDate'].'\',\''.$t['title'].'\',\''.$t['amount'].'\')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>';
      $str .= '<button type="button" class="btn btn-default" aria-label="Left Align" onclick="editTransaction(\''.$t['id'].'\',\''.$t['transactionDate'].'\',\''.$t['title'].'\',\''.$t['amount'].'\')"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>';
      $str .= "</td>";
      $str .= "</tr>";
    }
    if($str == ""){
      echo NULL;
    }
    else{
      echo $str;
    }
}
else{
  return 0;
}
?>
