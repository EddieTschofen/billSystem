<?php
$htAccessPages = array("appartement","locataire");
$localURL = "";
for($pageIndex = 0; $pageIndex < sizeOf($htAccessPages);$pageIndex++){
  if(strrpos($_SERVER[REQUEST_URI],$htAccessPages[$pageIndex])){
      $localURL = (strrpos($_SERVER[REQUEST_URI],"?") > 0) ? "" : "../";
      break;
  };
}

//header of all pages
echo '
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="fr" />
<meta name="author" content="Eddie Tschofen" />

<script src="/plugin/jquery-3.2.1.min.js"></script>

<link rel="stylesheet" href="/plugin/jquery-ui-1.12.1/jquery-ui.min.css">
<script src="/plugin/jquery-ui-1.12.1/jquery-ui.js"></script>

<link rel="stylesheet" href="/plugin/bootstrap-3.3.7/css/bootstrap.min.css"/>
<link rel="stylesheet" href="/plugin/bootstrap-3.3.7/css/bootstrap-select.min.css"/>
<link rel="stylesheet" href="/mainStyle.css?v=0.01">
<link rel="stylesheet" href="'.$localURL.'style.css?v=0.10">

<link rel="icon" type="image/png" href="/favicon.png" />
';
?>
