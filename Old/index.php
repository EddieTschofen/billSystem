<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta http-equiv="Content-Language" content="fr" />
      <meta name="author" content="Eddie Tschofen" />
      <link rel="stylesheet" href="style.css?version=0.3">
      <title>
         Formulaire Facture
      </title>
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   </head>
   <body>
      <script>
        var i = 0;
        function addDetailsLine(){
          var node = document.createElement("input");
          node.type = "text";
          node.name = "date"+i;
          var node1 = document.createElement("input");
          node1.type = "text";
          node1.name = "name"+i;
          var node2 = document.createElement("input");
          node2.type = "text";
          node2.name = "amount"+i;


          node.placeholder = "date jj/mm/aaaa"
          node1.placeholder = "Intitulé";
          node2.placeholder = "valeur";

          document.getElementById("detailsList").appendChild(node);
          document.getElementById("detailsList").appendChild(node1);
          document.getElementById("detailsList").appendChild(node2);
          document.getElementById("detailsList").appendChild(document.createElement("br"))
          i++;
        }
      </script>
      <?php
        $owners = ["Christophe","Beatrice","Bernard","Didier"];
        for($i=0;$i<sizeOf($owners);$i++){
          echo "<button onclick='fill".$owners[$i]."()'>".$owners[$i]."</button>";
        }
        echo "<br/>";
        for($i = 1; $i<9;$i++){
          echo "<button onclick='fillFlat".$i."()'>".$i."</button>";
        }
      ?>
      <br/><br/>
      <form action="bill.php" target="_blank">
          Info Facture: <br/>
          Num Avis d'échéance : <input type="text" name="billNumber" value=<?php echo date('y')."xxxx";?>> <br/>
          Periode du : <input type="text" name="startPeriode" value=""> au <input type="text" name="endPeriode" value=""> (jj/mm/aaaa)<br/>
          Numero Appartement : <input type="text" name="flatNumber" value=""> <br/>
          <br/>
          detail facture : <br/>
          Reste à payer : <input type="text" name="stillToPay" value="">  € <br/>
          Detail (date - nom - montant) : <button type="button" id="addDetail" onclick="addDetailsLine()">ajouter details</button> <br/>
          <ul id="detailsList"></ul>
          <div id="personsDiv">
              <div id="ownerDiv" class="div">
                <fieldset>
                  <legend>Propriétaire</legend>
                  Nom : <input type="text" name="ownerName" value=""> <br/>
                  Adresse : <input type="text" name="ownerAddress" value=""> <br/>
                  Code postal : <input type="text" name="ownerZip" value=""> <br/>
                  Ville : <input type="text" name="ownerCity" value=""> <br/>
                  Telephone Fixe : <input type="text" name="ownerPhone" value=""> <br/>
                  Telephone Portable  : <input type="text" name="ownerCell" value=""> <br/>
                  E-mail : <input type="text" name="ownerMail" value=""> <br/>
                  <br/>
                  Info Banquaire : <br/>
                  Banque : <input type="text" name="bankName" value=""> <br/>
                  IBAN : <input type="text" name="ownerIBAN" value=""> <br/>
                  BIC : <input type="text" name="ownerBIC" value=""> <br/>
                </fieldset>
              </div>
              <br/><br/>
              <div id="tenantDiv" class="div">
                <fieldset>
                  <legend>Locataire</legend>
                  Nom : <input type="text" name="tenantName" value=""> <br/>
                  Adresse : <input type="text" name="tenantAddress" value=""> <br/>
                  Code postal : <input type="text" name="tenantZip" value=""> <br/>
                  Ville : <input type="text" name="tenantCity" value=""> <br/>
                  Téléphone Fixe : <input type="text" name="tenantPhone" value=""> <br/>
                  <br/>
                  Dernière Info Banquaire Locataire: <br/>
                  Type : <select name="lastType">
                          <option value="virement">Virement</option>
                          <option value="virementSepa">Virement SEPA</option>
                          <option value="chèque">Chèque</option>
                          <option value="espèce">Espèce</option>
                          <option value="prelèvement">Prelèvement</option>
                      </select> <br/>
                  Date : <input type="text" name="lastDate" value=""> <br/>
                  Montant : <input type="text" name="lastAmount" value=""> € <br/>
                  Banque : <input type="text" name="lastBankName" value=""> <br/>
                  IBAN : <input type="text" name="lastTenantIBAN" value=""> <br/>
                  BIC : <input type="text" name="lastTenantBIC" value=""> <br/>
                </fieldset>
              </div>
          </div>
          Commentaires : <br/>
          <textarea rows="6" cols="50" name="comment"></textarea> <br/>
          <input type="submit" value="Submit">
      </form>
   </body>
   <script>

    function fillFlat1(){
        $("input[name = 'flatNumber']").attr("value","1");
    }

    function fillFlat7(){
        $("input[name = 'flatNumber']").attr("value","7");
        fillDidier();
        fillSandrineVernay();
    }

    function fillFlat8(){
        $("input[name = 'flatNumber']").attr("value","8");
        fillDidier();
        fillJocelyneMignerey();
    }

    function fillDidier(){
      $("input[name = 'ownerName']").attr("value","Didier Tschofen");
      $("input[name = 'ownerAddress']").attr("value","7, Avenue Général Roux");
      $("input[name = 'ownerZip']").attr("value","38800");
      $("input[name = 'ownerCity']").attr("value","Pont de Claix");
      $("input[name = 'ownerPhone']").attr("value","04 76 98 28 23");
      $("input[name = 'ownerCell']").attr("value","06 13 71 26 37");
      $("input[name = 'ownerMail']").attr("value","didiertschofen@hotmail.com");

      $("input[name = 'bankName']").attr("value","CIC Val Thorens");
      $("input[name = 'ownerIBAN']").attr("value","FR76 1009 6182 2400 0638 1540 131");
      $("input[name = 'ownerBIC']").attr("value","CMC1FRPP");
    }
    function fillBernard(){}
    function fillBeatrice(){}
    function fillChristophe(){}

    function fillVillaTranquille(){
      $("input[name = 'tenantAddress']").attr("value","163, Route du Crêt");
      $("input[name = 'tenantZip']").attr("value","74110");
      $("input[name = 'tenantCity']").attr("value","Essert-Romand");
    }

    function fillSandrineVernay(){
      fillVillaTranquille();
      $("input[name = 'tenantName']").attr("value","Sandrine Vernay");
      $("input[name = 'tenantPhone']").attr("value","06 79 55 06 93");

      // $("input[name = 'lastDate']").attr("value","32/02/16");
      // $("input[name = 'lastAmount']").attr("value","500");
      // $("input[name = 'lastBankName']").attr("value","LBP Centre Montpellier");
      // $("input[name = 'lastTenantIBAN']").attr("value","FR14 2004 1010 0907 50 910");
      // $("input[name = 'lastTenantBIC']").attr("value","PSSTFRPPMON");
    }

    function fillJocelyneMignerey(){
      fillVillaTranquille();
      $("input[name = 'tenantName']").attr("value","Jocelyne Mignerey");
      $("input[name = 'tenantPhone']").attr("value","06 61 09 89 23");

      // $("input[name = 'lastDate']").attr("value","32/02/16");
      // $("input[name = 'lastAmount']").attr("value","500");
      // $("input[name = 'lastBankName']").attr("value","LBP Centre Montpellier");
      // $("input[name = 'lastTenantIBAN']").attr("value","FR14 2004 1010 0907 50 910");
      // $("input[name = 'lastTenantBIC']").attr("value","PSSTFRPPMON");
    }

    // function fillJulieTartenpion(){
    //   $("input[name = 'tenantName']").attr("value","Julie Tartenpion");
    //   $("input[name = 'tenantAddress']").attr("value","17 avenue de la boustifaille");
    //   $("input[name = 'tenantZip']").attr("value","38666");
    //   $("input[name = 'tenantCity']").attr("value","SatanVille");
    //   $("input[name = 'tenantPhone']").attr("value","04 76 66 66 66");
    //
    //   $("input[name = 'lastDate']").attr("value","32/02/16");
    //   $("input[name = 'lastAmount']").attr("value","500");
    //   $("input[name = 'lastBankName']").attr("value","LBP Centre Montpellier");
    //   $("input[name = 'lastTenantIBAN']").attr("value","FR14 2004 1010 0907 50 910");
    //   $("input[name = 'lastTenantBIC']").attr("value","PSSTFRPPMON");
    //
    //   $("input[name = 'stillToPay']").attr("value","320");
    // }

    // $("input[name = 'startPeriode']").attr("value","01/02/2017");
    // $("input[name = 'endPeriode']").attr("value","28/02/2017");

    $("textarea[name = 'comment']").text("");
   </script>
</html>
