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

 
 function getTextGeneral($idText){
    global $languaje;
    $TEXT = General::getText($idText, $languaje);
    echo $TEXT['textLanguage'];
}

?>

<!DOCTYPE html>
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

  <!-- =======================================================
    Theme Name: Imperial
    Theme URL: https://bootstrapmade.com/imperial-free-onepage-bootstrap-theme/
    Author: BootstrapMade.com
    Author URL: https://bootstrapmade.com
  ======================================================= -->
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
          <li class="menu-active"><a href="index.php#hero"><?php echo getTextGeneral(6); ?></a></li>
          <li><a href="index.php#about"><?php echo getTextGeneral(7); ?></a></li>
          <li><a href="index.php#services"><?php echo getTextGeneral(8); ?></a></li>
          <li><a href="index.php#team"><?php echo getTextGeneral(9); ?></a></li>
          <li><a href="index.php#contact"><?php echo getTextGeneral(10); ?></a></li>
          <li><a href=""><?php echo getTextGeneral(11); ?></a></li>
          <li><a href="<?php echo 'porConcepto.php?lang=1' ?>"><img src="img/icon_sp.png" alt="" width="30" height="30" title="Spain" /></a></li>
          <li><a href="<?php echo 'porConcepto.php?lang=2' ?>"><img src="img/icon_en.png" alt="" width="30" height="30" title="English" /></a></li>
          <li><a href="<?php echo 'porConcepto.php?lang=3' ?>"><img src="img/icon_fr.png" alt="" width="30" height="30" title="France" /></a></li>
          <!--li class="menu-active"><a href="#hero">Home</a></li-->
          <!--li><a href="#about">Presentación</a></li-->
          <!--li><a href="#services">Glosario</a></li-->
          <!--li><a href="#team">Autores</a></li-->
          <!--li><a href="#contact">Contacto</a></li-->
          <!--li><a href="#contact">Buscador</a></li-->
        </ul>
      </nav>
      <!-- #nav-menu-container -->
    </div>
  </header>
  <!-- #header -->

  
  <!--==========================
  Services Section
  ============================-->
  <section id="services">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title">nombre materia</h3>
          <div class="section-title-divider"></div>
          <p class="section-description">- Concepto -</p>
        </div>
      </div>

      <div class="row">
           <?php 
          $conceptos = getMateriaConceptoGen(); 
         
         foreach ($conceptos as $concepto)
          {
         echo '<div class="col-md-4 service-item2">';
         echo '<div class="service-icon"><i class="fa fa-file"></i></div>';
         echo '<h4 class="service-title"><a href="Concepto.php?id='.$concepto["idConcepto"].'">'. $concepto["nombreConcepto"].'</a></h4>';
         echo '<p class="service-description">Pulsa en '. $concepto["nombreConcepto"] .' y podrás acceder al contenido del concepto.</p></div>';
        }
          ?>
        
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

</body>

</html>
