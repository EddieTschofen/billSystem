<div id="disclamer">

<?php
  // echo $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."<br/>".$_SERVER['HTTP_HOST']."<br/>".$_SERVER['PHP_SELF'];
  if($_SERVER['PHP_SELF'] === "/index.php"){
    echo 'Vous pourrez bientôt trouver <a href="/help">ici</a> un tutoriel sur la création d\'une facture';
  }
?>

<button onclick="closeDisclamer()" id="disclamerButton">x</button>
</div>
<script>
function closeDisclamer(){
  // alert("x");
  $("#disclamer").remove();
}
</script>
