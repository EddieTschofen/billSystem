<?php
if(!isset($_GET['id'])) header('Location: /');

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
         Log in
      </title>
   </head>
   <body>
     <?php
       require $_SERVER['DOCUMENT_ROOT'].'/toolbox/head.php';
     ?>
      <div id='main'>
        <?php
          $query = "SELECT * FROM Tenant WHERE id=".$_GET['id'];
          $tenant = $bdd->query($query)->fetch();
//          var_dump($tenant);
        ?>
      <fieldset>
          <legend id="legendBlock"><?php echo $tenant['name'] ?></legend>
<!--        <img width="100%" src="/toolbox/UC.png">-->
      </fieldset>
      </div>
  </body>
</html>
