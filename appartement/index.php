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
        </fielset>
        <hr>
        <button onclick="createBill()">Générer une facture</button>
        <br/>
        <button onclick="transactionFieldset(true)">Ajouter une transaction</button>
        <fieldset id="trans">
        <legend>Nouvelle Transaction</legend>
        <div id="nouvelleTransaction" title="Nouvelle transaction">
            <fieldset>
              <table>
                <tr><td><label>Date : </label> </td><td><input type="text" id="datepicker"></tr>
                <tr><td><label>Titre : </label></td><td> <input type="text" name="title" id="title" value=""></tr>
                <tr><td><label>Montant : </label></td><td> <input type="number" min="0" name="amount" id="amount" value=""></tr>
                <tr><td colspan=2><input type="radio" id="payable" name="transactionType" value="creance">
                Créance <input type="radio" id="payment" name="transactionType" value="payment"> Paiement</tr>
              </table>
              <p style="padding-top:10px;margin:0px;" id="err">Tous les champs sont obligatoire</p>
              <button onclick="transactionFieldset(false)" >Annuler</button>
              <button onclick="addTransaction()" >Ajouter transaction</button>
            </fieldset>
          </div>
        </fieldset>
        <br/>
        <!--<button onclick="addMonthlyClaim()">Créance mensuel pour cet appartement</button>-->
        <table id="transactionsTable"></table>
        <br/>
      </div>
  </body>

  <script src="<?php echo $localURL;?>script.js?v=0.02"></script>
</html>
