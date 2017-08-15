<?php
  $flatNum=$_GET['flat'];
  if(!isset($_GET['flat'])) header('Location: /');

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

      <script src="<?php echo $localURL;?>script.js"></script>
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
          <legend id="legendBlock"><?php echo $block['name'] ?></legend>
          <?php
            echo '<span id="flatID" class="invisible">'.$flatInfo['id']."</span>";
            echo 'Appartement <span id="flatNum">'.$flatInfo['flat_num'].'</span><br/>';
            echo "<span id='tenantAddressSpan'>".$block['address']."</span>, <span id='tenantZipSpan'>".$block['zip']."</span> <span id='tenantCitySpan'>".$block['city']."</span>";
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
            echo "<legend id=\"legendName\"><a href='/locataire/?id=".$tenant['id']."'>".$tenant['name']."</a></legend>";
            echo "<span id='tenantPhoneSpan'>".$tenant['phone']."</span>";
            echo "<br/><br/>";
          }?>
          <legend>Historique des transactions</legend>
          <!-- transactions table -->
          <table id="transactionsTable"></table>
        <br/>
        <button onclick="addTransaction()">Ajouter Transaction</button>
        </fieldset>
        <button onclick="createBill()">Editer facture</button>
      </div>
  </body>
</html>
