<?php
//nav menu on top of pages
$name = $bdd->query('SELECT Owner.login FROM Session,Owner where Session.userID="'.$_SESSION['user'].'" and Session.userID=Owner.id')->fetch()['login'];
echo '
<ul>
  <li><a id="homeMenu" href="/" class="active">Home</a></li>
  <li><a id="billMenu" href="/facture">Factures Enregistrées</a></li>


  <div class="right">
    <li><a id="login" href="/profil">'.$name.'</a></li>
    <li><a href="/toolbox/logout.php">Se deconnecter</a></li>
    <li><a id="helpMenu" style="padding-left:10px;padding-right:10px" href="/help/"><img width="10px" src="/appartement/img/questionMark.svg.png"></a></li>
  </div>
</ul>
';
?>
