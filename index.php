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

          // header('Location: /login/');
          // echo  __DIR__.'/toolbox/header.php';
          // $dir    = '/';
          // $files1 = scandir($dir);
          // $files2 = scandir($dir, 1);
          //
          // print_r($files1);
          // print_r($files2);
      ?>
  </body>
</html>
