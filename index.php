<?php
  require $_SERVER['DOCUMENT_ROOT'].'/toolbox/dbLogIn.php';
  require $_SERVER['DOCUMENT_ROOT'].'/toolbox/isAuth.php';
?>

<!DOCTYPE html>
<html>
   <head>
      <?php
          require $_SERVER['DOCUMENT_ROOT'].'/toolbox/header.php';
      ?>
      <title>
         Home
      </title>
   </head>
   <body>
      <?php
        require $_SERVER['DOCUMENT_ROOT'].'/toolbox/head.php';
      ?>
      <div id='main'>
        <?php
          echo "<table>";
          //get Appartement blocks where the user has Appartement
          $query = $bdd->query('select a.* FROM Flat f, Apartment_block a WHERE f.ownerID="'.$_SESSION['user'].'" and f.blockID=a.id GROUP BY a.id');
          //for each one
          while($res = $query->fetch()){
            //create a table part with the name and address of block
            echo "<tr><th>".$res['name']."</th><th>".$res['address'].", ".$res['zip']." ".$res['city']."</th></tr>";
            //get all the Appartement owned by the user in the block
            $query2 = $bdd->query('select * FROM Flat WHERE ownerID="'.$_SESSION['user'].'" and blockID="'.$res['id'].'"');
            //for each one
            while($res2 = $query2->fetch()){
              //get the tenant name if there is one
              $res3 = $bdd->query('select * FROM Tenant WHERE id in (select tenantID FROM  Rental Where flatID="'.$res2['id'].'")')->fetch();
              // if there is no tenant
              if(!$res3){
                echo "<tr><td>Appartement ".$res2['flat_num']."</td><td>"."pas de locataire"."</td></tr>";
              }
              //if there is one
              else{
                echo "<tr><td>Appartement ".$res2['flat_num']."</td><td>".$res3['name']."</td></tr>";
              }
            }
          }
          echo "</table>";
        ?>

      </div>
  </body>
</html>
