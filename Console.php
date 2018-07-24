 <!-- Main Stylesheet File -->
 <?php

require 'General.php';
session_start();

$login_session = General::getUserSession();

?>
<html>
<head>
    <title>Console
    </title>
   <link href="css/styleLogin.css" rel="stylesheet">
    </head>
    <body>
   

<div class="login-page">
    <h2><a href="Logout.php">Logout</a></h2>
  <div class="form">
   <h1>Welcome <?php echo $login_session;?></h1>
  </div>
</div>  
    </body>
</html>