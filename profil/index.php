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
         Profil
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
        <table>
          <tr>
            <td>Nom d'utilisateur : </td>
            <td><input type="text" name="ownerUsername" value="<?php echo $profil['login'];?>" disabled></td>
          </tr>
          <tr>
            <td>Mot de passe : </td>
            <td><input type="password" name="ownerPassword" value="xxx" disabled></td>
          </tr>
        </table>
        <br/>
        <button>Editer mot de passe</button><br/><br/>
        <table>
          <tr>
            <td>Nom : </td>
            <td><input type="text" name="ownerName" value="<?php echo $profil['name'];?>" disabled></td>
          </tr>
          <tr>
            <td>Adresse : </td>
            <td><input type="text" name="ownerAddress" value="<?php echo $profil['address'];?>" disabled></td>
          </tr>
          <tr>
            <td>Code postal : </td>
            <td><input type="text" name="ownerZip" value="<?php echo $profil['zip'];?>" disabled></td>
          </tr>
          <tr>
            <td>Ville : </td>
            <td><input type="text" name="ownerCity" value="<?php echo $profil['city'];?>" disabled></td>
          </tr>
          <tr>
            <td>Telephone Fixe : </td>
            <td><input type="text" name="ownerPhone" value="<?php echo $profil['phone'];?>" disabled></td>
          </tr>
          <tr>
            <td>Telephone Portable  : </td>
            <td><input type="text" name="ownerCell" value="<?php echo $profil['cell'];?>" disabled></td>
          </tr>
          <tr>
            <td>E-mail : </td>
            <td><input type="text" name="ownerMail" value="<?php echo $profil['email'];?>" disabled></td>
          </tr>
        </table>
        <br/>
        <table>
          <tr>
            <td>Banque : </td>
            <td><input type="text" name="bankName" value="<?php echo $profil['bankName'];?>" disabled></td>
          </tr>
          <tr>
            <td>IBAN : </td>
            <td><input type="text" name="ownerIBAN" value="<?php echo $profil['IBAN'];?>" disabled></td>
          </tr>
          <tr>
            <td>BIC : </td>
            <td><input type="text" name="ownerBIC" value="<?php echo $profil['BIC'];?>" disabled></td>
          </tr>
        </table>

        <br/>
        <button>Editer informations</button><br/><br/>

      </div>
  </body>
</html>