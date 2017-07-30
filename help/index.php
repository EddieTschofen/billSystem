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
         Log in
      </title>
   </head>
   <body>
     <?php
       require $_SERVER['DOCUMENT_ROOT'].'/toolbox/head.php';
     ?>
     <script>
       $("#homeMenu").removeClass("active");
       $("#helpMenu").addClass("active");
     </script>
      <div id='main'>
        <img width="100%" src="/toolbox/UC.png">
      </div>
  </body>
</html>
