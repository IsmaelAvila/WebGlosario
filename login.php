   <!-- Place your favicon.ico and apple-touch-icon.png in the template root directory -->
  <link href="favicon.ico" rel="shortcut icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate-css/animate.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/styleLogin.css" rel="stylesheet">
 <?php

require 'General.php';
session_start();

if($_SERVER["REQUEST_METHOD"]=="POST"){
   
    $userName = $_POST["username"];
    $password = $_POST["password"];
    
    $row = General::login($userName,$password);
   
    if (count($row) > 0){
        $_SESSION['login_user'] = $userName;
        header("location:Adminis.php");
    }else{
        $error = "Tu nombre o usuario es invalido";
    }
    
}

?>
<html>
<head>
    <title>Login</title>
   
    </head>
    <body>
   

<div class="login-page">
  <div class="form">
    <!--form class="register-form" method="post">
      <input type="text" placeholder="name" />
      <input type="password" placeholder="password" />
      <input type="text" placeholder="email address"/>
      <button>create</button>
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form-->
    <form  action="" method="post">
        <input type="text" placeholder="username" name="username"/>
        <input type="password" placeholder="password" name="password"/>
        <input type="submit" value="Login">
    </form>
      <div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
  </div>
</div>  
<center><a href="http://localhost/WebGlosario/" class="btn">Volver al Glosario</a></center>
    </body>
</html>
