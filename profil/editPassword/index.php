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
         Edition mot de passe
      </title>
   </head>
   <body>
      <?php
        require $_SERVER['DOCUMENT_ROOT'].'/toolbox/head.php';
      ?>
      <?php
        $profil = $bdd->query('SELECT * from Owner WHERE id="'.$_SESSION['user'].'"')->fetch();
      ?>
      <div id='main'>
        <form action="edit.php" method="post">
        <table>
          <tr>
            <td>Nom d'utilisateur : </td>
            <td><input type="text" name="ownerUsername" value="<?php echo $profil['login'];?>" disabled></td>
          </tr>
          <tr>
            <td>Ancien mot de passe : </td>
            <td><input type="password" name="ownerOldPassword" value=""></td>
          </tr>
          <tr>
            <td>Nouveau mot de passe : </td>
            <td><input type="password" name="ownerNewPassword" value=""></td>
          </tr>
          <tr>
            <td>Confirmation nouveau mot de passe : </td>
            <td><input type="password" name="ownerNewPasswordConfirmation" value=""></td>
          </tr>
        </table>
      <?php
        //error message
        switch ($_GET['m']) {
          case 'cmdp':
            echo "<p id='c'>Le mot de passe a été changé</p>";
            break;
          case 'nmdp':
            echo "<p id='n'>Le nouveau mot de passe ne correspond pas à la confirmation</p>";
            break;
          case 'omdp':
            echo "<p id='o'>L'ancien mot de passe n'est pas valide</p>";
            break;
          default:
            break;
        }
      ?>
        <input type="submit" value="Modifier mot de passe">
      </form>
        <br/>
      </div>
  </body>
</html>
