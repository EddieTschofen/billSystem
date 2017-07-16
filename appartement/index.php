<?php
  $flatNum=$_GET['flat'];
  require $_SERVER['DOCUMENT_ROOT'].'/toolbox/dbLogIn.php';
  require $_SERVER['DOCUMENT_ROOT'].'/toolbox/isAuth.php';
  require $_SERVER['DOCUMENT_ROOT'].'/toolbox/isOwner.php';
?>

<!DOCTYPE html>
<html>
   <head>
      <?php
          require $_SERVER['DOCUMENT_ROOT'].'/toolbox/header.php';
      ?>
      <title>
         Appartement
      </title>
   </head>
   <body>
      <?php
        require $_SERVER['DOCUMENT_ROOT'].'/toolbox/head.php';
      ?>
      <div id='main'>
        <?php
            $block = $bdd->query('SELECT * from Apartment_block')->fetch();
            $tenant = $bdd->query('select * FROM Tenant WHERE id in (select tenantID FROM  Rental Where flatID="'.$flatNum.'")')->fetch();
        ?>
        <fieldset>
          <legend><?php echo $block['name'] ?></legend>
          <?php
            echo 'Appartement '.$flatInfo['id'].'<br/>';
            echo $block['address'].", ".$block['zip']." ".$block['city'];
          ?>
        </fieldset>
        <br/>
        <fieldset>
          <?php
          // if there is no tenant
          if(!$tenant){
            echo "<legend> Pas de locataire</legend>";
          }
          //if there is one
          else{
            echo "<legend><a href='/locataire/".$tenant['id']."'>".$tenant['name']."</a></legend>";
            echo $tenant['phone'];
            echo "<br/><br/>";
          }?>
          <legend>Historique des transactions</legend>
          <table>
          <?php
            $transactions = $bdd->query('SELECT * FROM Transaction ORDER BY transactionDate');
            while($t = $transactions->fetch()){
              echo "<tr>";
              echo "<td class='tdBox'>".$t['transactionDate']."</td>";
              echo "<td class='titleBox'>".$t['title']."</td>";
              echo "<td class='amountBox'>".$t['amount']."€</td>";
              echo "<td class='buttonBox'>";
              echo '<button type="button" class="btn btn-default" aria-label="Left Align"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>';
              echo '<button type="button" class="btn btn-default" aria-label="Left Align"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>';
              echo "</td>";
              echo "</tr>";
            }
          ?>
        </table>
        </fieldset>

      </div>
  </body>
</html>
