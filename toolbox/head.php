<?php
// echo 'SELECT Users.login FROM Sessions,Users where Sessions.userID="'.$_SESSION['user'].'" and Sessions.userID=Users.id';
$name = $bdd->query('SELECT Owner.login FROM Sessions,Owner where Sessions.userID="'.$_SESSION['user'].'" and Sessions.userID=Owner.id')->fetch()['login'];
echo '
<ul>
  <li><a class="active" href="#home">Home</a></li>
  <li><a href="#news">News</a></li>


  <div class="right">
    <li><a href="/profil">'.$name.'</a></li>
    <li><a href="/logout.php">Se deconnecter</a></li>
  </div>
</ul>
';
?>
