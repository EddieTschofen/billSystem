<?php
//nav menu on top of pages
$name = $bdd->query('SELECT Owner.login FROM Sessions,Owner where Sessions.userID="'.$_SESSION['user'].'" and Sessions.userID=Owner.id')->fetch()['login'];
echo '
<ul>
  <li><a class="active" href="/">Home</a></li>
  <li><a href="#news">News</a></li>


  <div class="right">
    <li><a id="login" href="/profil">'.$name.'</a></li>
    <li><a href="/toolbox/logout.php">Se deconnecter</a></li>
  </div>
</ul>
';
?>
