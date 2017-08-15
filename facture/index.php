<?php
  require $_SERVER['DOCUMENT_ROOT'].'/toolbox/dbLogIn.php';
  require $_SERVER['DOCUMENT_ROOT'].'/toolbox/isAuth.php';
  // session_start();
  // var_dump($_COOKIE);
  // echo "<br/>";
  // var_dump($_SESSION);
?>

<!DOCTYPE html>
<html>
   <head>
      <?php
          require $_SERVER['DOCUMENT_ROOT'].'/toolbox/header.php';
      ?>
      <title>
         Facture
      </title>
      <script src="script.js"></script>
   </head>
   <body>
      <?php
        require $_SERVER['DOCUMENT_ROOT'].'/toolbox/head.php';
      ?>
      <script>
        $("#homeMenu").removeClass("active");
        $("#billMenu").addClass("active");
      </script>
      <div id='main'>
        <h1>Factures</h1>
        <?php
          // $query = 'SELECT * FROM Bill WHERE rentalID in (
          //   SELECT id FROM Rental WHERE flatID in (
          //     SELECT id FROM Flat WHERE ownerID="'.$_SESSION['user'].'" ORDER BY blockID
          //   )
          // ) ORDER BY rentalID, billNumber';


          $query = 'SELECT * FROM Apartment_block WHERE id IN (
            SELECT blockID FROM Flat WHERE ownerID="'.$_SESSION['user'].'"
          )';
          $q = $bdd->query($query);
          // echo $query;
          while($r = $q->fetch()){
            // var_dump($r);echo "<br/>";echo "<br/>";
            echo '<fieldset>
            <legend>'.$r['name'].'</legend>';
            $query2 = 'SELECT * FROM Flat WHERE blockID="'.$r['id'].'" AND ownerID="'.$_SESSION['user'].'"';
            $q2 = $bdd->query($query2);
            while($r2 = $q2->fetch()){
              // var_dump($r2);echo "<br/>";echo "<br/>";
              $query3 = 'SELECT * FROM Bill WHERE rentalID in (
                SELECT id FROM Rental WHERE flatID="'.$r2['id'].'"
              )';
              $billNo = count($bdd->query($query3)->fetchAll());
              if($billNo > 0){
                echo '<h3>Appartement '.$r2['flat_num'].'</h3>';
                $q3 = $bdd->query($query3);
                $table = "<table>";
                while($r3 = $q3->fetch()){
                  $query4 = 'SELECT name FROM Tenant WHERE id IN (
                    SELECT tenantID FROM Rental WHERE id="'.$r3['rentalID'].'"
                  )';
                  $table .= '
                  <tr>
                    <td>
                      '.$r3['billNumber'].'
                    </td>
                    <td>
                      '.$r3['startPeriode'].'
                    </td>
                    <td>
                      '.$r3['endPeriode'].'
                    </td>
                    <td>
                      '.$bdd->query($query4)->fetch()[0].'
                    </td>
                    <td>
                      <a href="bill.php?id='.$r3['id'].'" target="_blank"><button>Voir facture</button></a>
                    </td>
                    <td>
                      <button type="button" class="btn btn-default" aria-label="Left Align" onclick="deleteSavedBill(\''.$r3['id'].'\')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                    </td>
                  </tr>
                  ';
                }
                // <button onclick="displayBill(\''.$r3['id'].'\')">Voir facture</button>

                $table .= "</table>";
                echo $table;
              }
            }
            echo '</fieldset>';
          }
        ?>
      </div>
  </body>
</html>
