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
         Edition des informations
      </title>
   </head>
   <body>
      <?php
        require $_SERVER['DOCUMENT_ROOT'].'/toolbox/head.php';
      ?>
      <?php
        $profil = $bdd->query('SELECT * from Owner WHERE id="'.$_SESSION['user'].'"')->fetch();
        // var_dump($profil);
      ?>
      <div id='main'>
        <form action="edit.php" method="post">
          <table>
            <tr>
              <td>Nom : </td>
              <td><input type="text" name="ownerName" value="<?php echo $profil['name'];?>"></td>
            </tr>
            <tr>
              <td>Adresse : </td>
              <td><input type="text" name="ownerAddress" value="<?php echo $profil['address'];?>"></td>
            </tr>
            <tr>
              <td>Code postal : </td>
              <td><input type="text" name="ownerZip" value="<?php echo $profil['zip'];?>"></td>
            </tr>
            <tr>
              <td>Ville : </td>
              <td><input type="text" name="ownerCity" value="<?php echo $profil['city'];?>"></td>
            </tr>
            <tr>
              <td>Telephone Fixe : </td>
              <td><input type="text" name="ownerPhone" value="<?php echo $profil['phone'];?>"></td>
            </tr>
            <tr>
              <td>Telephone Portable  : </td>
              <td><input type="text" name="ownerCell" value="<?php echo $profil['cell'];?>"></td>
            </tr>
            <tr>
              <td>E-mail : </td>
              <td><input type="text" name="ownerMail" value="<?php echo $profil['email'];?>"></td>
            </tr>
          </table>
          <br/>
          <table>
            <tr>
              <td>Banque : </td>
              <td><input type="text" name="bankName" value="<?php echo $profil['bankName'];?>"></td>
            </tr>
            <tr>
              <td>IBAN : </td>
              <td><input type="text" name="ownerIBAN" value="<?php echo $profil['IBAN'];?>"></td>
            </tr>
            <tr>
              <td>BIC : </td>
              <td><input type="text" name="ownerBIC" value="<?php echo $profil['BIC'];?>"></td>
            </tr>
          </table>
          <br/>
          <table>
            <tr>
              <td>mot de passe : </td>
              <td><input type="password" name="ownerPassword" value=""></td>
            </tr>
          </table>
          <?php
            switch ($_GET['m']) {
              case 'mdp':
                echo "<p id='mdp'>Mot de passe érroné</p>";
                break;
              case 'ok':
                echo "<p id='ok'>Les informations ont été modifiées</p>";
                break;
              default:
                break;
            }
        ?>
        <input type="submit" value="Modifier information">
      </form>
        <br/>
      </div>
  </body>
</html>
