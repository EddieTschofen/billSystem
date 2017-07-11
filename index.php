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
         Main
      </title>
   </head>
   <body>
      <?php
        require $_SERVER['DOCUMENT_ROOT'].'/toolbox/head.php';
      ?>
      <div id='main'>
        <?php
          echo "<table>";
          $query = $bdd->query('select a.* FROM Flat f, Apartment_block a WHERE f.ownerID="'.$_SESSION['user'].'" and f.blockID=a.id GROUP BY a.id');
          while($res = $query->fetch()){
            echo "<tr><th>".$res['name']."</th><td>".$res['address'].", ".$res['zip']." ".$res['city']."</td></tr>";
            $query2 = $bdd->query('select * FROM Flat WHERE ownerID="'.$_SESSION['user'].'" and blockID="'.$res['id'].'"');
            while($res2 = $query2->fetch()){
              $res3 = $bdd->query('select * FROM Tenant WHERE id in (select tenantID FROM  Rental Where flatID="'.$res2['id'].'")')->fetch();
              if(!$res3){
                echo "<tr><td>Appartement ".$res2['flat_num']."</td><td>"."pas de locataire"."</td></tr>";
              }
              else{
                echo "<tr><td>Appartement ".$res2['flat_num']."</td><td>".$res3['name']."</td></tr>";
              }
            }
          }
          echo "</table>";


          while($res3 = $query3->fetch()){
            var_dump($res3);
          }
        ?>

      </div>
  </body>
</html>
