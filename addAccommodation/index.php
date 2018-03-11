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
         Appartement
      </title>

   </head>
   <body>
      <?php
        require $_SERVER['DOCUMENT_ROOT'].'/toolbox/head.php';
      ?>
      <div id='main'>
        Add Accommodation
        <?php
          $blocks = $bdd->query('SELECT * from Apartment_block')->fetchAll();
//          var_dump($blocks);
//          echo sizeof($blocks);
        ?>
        <form name="newFlat" action="add.php" method="post" onsubmit="return validateForm()">
            <select id="blockSelect" name="block">
                <option disabled selected value> --- Choisir un immeuble --- </option>
                <option value="newBlock"> - Nouvel immeuble - </option>
                <?php
                    for($i = 0; $i<sizeof($blocks); $i++)
                        echo "<option value='".$blocks[$i]['id']."'>".$blocks[$i]['name']."</option>";
                ?>
            </select>
            <br/>
            <div id="newBlockForm">
                <label>Nom : </label> <input name="name" type="text"/><br/>
                <label>Adresse : </label> <input name="address" type="text"/><br/>
                <label>Ville : </label> <input name="city" type="text"/><br/>
                <label>Zip : </label> <input name="zip" type="text"/>
            </div>
            <?php
                for($i = 0; $i<sizeof($blocks); $i++) {
                    $query = 'SELECT * from Flat WHERE blockID=' . $blocks[$i]['id'] . ' ORDER BY flat_num';
                    $flats = $bdd->query($query)->fetchAll();
                    $str = "";
                    for ($j = 0; $j < sizeof($flats) - 1; $j++) {
                        $str .= $flats[$j]['flat_num'].", ";
                    }
                    $str .= $flats[sizeof($flats)-1]['flat_num'];
                    echo "<div class='block_detail' id='detail_".$blocks[$i]['id']."'>" . $blocks[$i]['name'] . " - " . $blocks[$i]['address'] . " " . $blocks[$i]['zip'] . " " . $blocks[$i]['city'] . "<span class='blocksFlat'> appartement dans cet immeuble : $str</span></div>";
                }
            ?>
            <br/>
            <label>Numéro appartement : </label> <input name="flatNum" type="number"/>

            <br/><br/><button type="submit">Valider</button>
        </form>
      </div>
  </body>

  <script src="<?php echo $localURL;?>script.js?v=0.03"></script>
</html>
