<!DOCTYPE html>
<?php

require 'General.php';
session_start();

$user_session = General::getUserSession();

$page = 1;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}

$rowGeneral = General::getConceptoMateria($page,0);

?>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Glosario</title>
  <link rel="shortcut icon" href="img/LOGO3.jpg">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Facebook Opengraph integration: https://developers.facebook.com/docs/sharing/opengraph -->
  <meta property="og:title" content="">
  <meta property="og:image" content="">
  <meta property="og:url" content="">
  <meta property="og:site_name" content="">
  <meta property="og:description" content="">

  <!-- Twitter Cards integration: https://dev.twitter.com/cards/  -->
  <meta name="twitter:card" content="summary">
  <meta name="twitter:site" content="">
  <meta name="twitter:title" content="">
  <meta name="twitter:description" content="">
  <meta name="twitter:image" content="">

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
 
</head>

<body>
 <header id="header">
    <div class="container">
      <div><h1><center>Buscador</center></h1></div>
      
    </div>
  </header>

<br>



<!--Concepto he pensado en estructurarlo primero accediendo alfabeticamente. El siguiente nivel es un listado de todos los conceptos de esa letra. Por último nivel mostrar el detalle de la letra.

En el caso de la materia, sería mostrar listado de todas las materias y al pulsar en una de ellas mandarte al detalle para modificarlo.-->
<input type="text" id="searchInput" name='search' placeholder="Buscar....">
    <div id="result"></div>
    
    
    <!-- Required JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="lib/superfish/hoverIntent.js"></script>
  <script src="lib/superfish/superfish.min.js"></script>
  <script src="lib/morphext/morphext.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/stickyjs/sticky.js"></script>
  <script src="lib/easing/easing.js"></script>

  <!-- Template Specisifc Custom Javascript File -->
  <script src="js/custom.js"></script>

  <script src="contactform/contactform.js"></script>
    <script>
        $(document).ready(function(){
            load_data();
            function load_data(query){
                
                $.ajax({
                    url:"backendSearch.php",
                    method:"POST",
                    data:{query:query},
                    success:function(data){
                        $('#result').html(data);
                    }
                });
            }
            $('#searchInput').keyup(function(){
                var search = $(this).val();
                if(search != ''){
                    load_data(search);
                }else{
                    load_data();
                }
            });
        });
  
</script>
</body>

</html>