<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta http-equiv="Content-Language" content="fr" />
      <meta name="author" content="Eddie Tschofen" />

    	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <!-- <script src = "index.js"></script> -->

      <link rel="stylesheet" href="style.css">
      <link rel="stylesheet" href="/bootstrap-3.3.7/css/bootstrap.min.css"/>
      <link rel="stylesheet" href="/bootstrap-3.3.7/css/bootstrap-select.min.css"/>
      <title>
         Log in
      </title>
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   </head>
   <body>
      <div id='login'>
        <h1 id="loginTitle">Connection au systeme de facturation</h1>
        <form action="login.php" method="post">
          <input class="formInput" type="text" id="username" name="username" value="" placeholder="username"> <br/>
          <input class="formInput" type="password" id="password" name="password" value="" placeholder="password"> <br/>
          <input class="loginButton" type="submit" value="Submit">
        </form>
      </div>
  </body>
</html>
