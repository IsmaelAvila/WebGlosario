<!DOCTYPE html>
<?php

require 'General.php';

$idMateria = 1;
if (isset($_GET['id'])) {
    $idMateria = $_GET['id'];
}

function getMateriaConceptoGen(){
     global $idMateria;
    $row = General::getMateriaExtendida($idMateria);
    return $row;
}

$languaje = 1;
if (isset($_GET['lang'])) {
    $languaje = $_GET['lang'];
}

$page = 1;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
 
 function getTextGeneral($idText){
    global $languaje;
    $TEXT = General::getText($idText, $languaje);
    echo $TEXT['textLanguage'];
}
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
  <div id="preloader"></div>

  <!--==========================
  Header Section
  ============================-->
   <header id="header">
    <div class="container">
      <div id="logo" class="pull-left">
        <a href="http://www.uco.es/" target="_blank"><img src="img/logoUco.png" alt="" title="" /></a>
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="index.php"><?php echo getTextGeneral(6); ?></a></li>
          <li><a href="index.php#about"><?php echo getTextGeneral(7); ?></a></li>
          <li><a href="index.php#services"><?php echo getTextGeneral(8); ?></a></li>
          <li><a href="index.php#team"><?php echo getTextGeneral(9); ?></a></li>
          <li><a href="index.php#contact"><?php echo getTextGeneral(10); ?></a></li>
          <li><a href="Buscador.php"><?php echo getTextGeneral(11); ?></a></li>
          <li><a href="<?php echo 'Buscador.php?page='.$page.'&lang=1' ?>"><img src="img/icon_sp.png" alt="" width="30" height="30" title="Spain" /></a></li>
          <li><a href="<?php echo 'Buscador.php?page='.$page.'&lang=2' ?>"><img src="img/icon_en.png" alt="" width="30" height="30" title="English" /></a></li>
          <li><a href="<?php echo 'Buscador.php?page='.$page.'&lang=3' ?>"><img src="img/icon_fr.png" alt="" width="30" height="30" title="France" /></a></li>
        </ul>
      </nav>
      <!-- #nav-menu-container -->
    </div>
  </header>
  <!-- #header -->

<br>

 <!--==========================
  Services Section
  ============================-->
  <section id="services">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title"><?php echo getTextGeneral(11); ?></h3>
          <div class="section-title-divider"></div>
        </div>
      </div>

<!--Concepto he pensado en estructurarlo primero accediendo alfabeticamente. El siguiente nivel es un listado de todos los conceptos de esa letra. Por último nivel mostrar el detalle de la letra.

En el caso de la materia, sería mostrar listado de todas las materias y al pulsar en una de ellas mandarte al detalle para modificarlo.-->
<input type="text" id="searchInput" name='search' placeholder="Buscar....">
    <div id="result"></div>
          </div> 
    </div>
  </section>

  <!--==========================
  Footer
============================-->
  <footer id="footer">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="copyright">
            &copy; Copyright <strong><?php echo getTextGeneral(20); ?> <?php echo getTextGeneral(2); ?> 2019</strong>. <?php echo getTextGeneral(21); ?> Ismael Ávila Ojeda.
          </div>
          <div class="credits">
            <img src="img/logoUco.png" alt="" title="" width="50" height="30"/>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a> 
    
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
                var page = <?php Print($page); ?>;
                var lang = <?php Print($languaje); ?>;
                $.ajax({
                    url:"backendSearch.php",
                    method:"POST",
                    data:{query:query,page:page,lang:lang},
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