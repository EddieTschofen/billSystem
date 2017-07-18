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

      <script src="script.js"></script>
   </head>
   <body onload="init()">
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
            echo 'Appartement <span id="flatID">'.$flatInfo['id'].'</span><br/>';
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
          <!-- transactions table -->
          <table id="transactionsTable"></table>
        <br/>
        <button onclick="addTransaction()">Ajouter Transaction</button>
        </fieldset>
      </div>
  </body>
</html>
