 <!-- Main Stylesheet File -->
 <?php

require 'General.php';
session_start();

if($_SERVER["REQUEST_METHOD"]=="POST"){
   
    $userName = $_POST["username"];
    $password = $_POST["password"];
    
    $row = General::login($userName,$password);
   
    if (count($row) > 0){
        $_SESSION['login_user'] = $userName;
        header("location:Console.php");
    }else{
        $error = "Tu nombre o usuario es invalido";
    }
    
}

?>
<html>
<head>
    <title>Login
    </title>
   <link href="css/styleLogin.css" rel="stylesheet">
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
    </body>
</html>
