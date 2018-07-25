<?php

require 'General.php';

$idconcepto = 1;
if (isset($_GET['id'])) {
    $idconcepto = $_GET['id'];
}

$row = General::getConcepto($idconcepto);

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
          <a href="http://www.uco.es/"><img src="img/logoUco.png" alt="" title="" /></a>
        <!-- Uncomment below if you prefer to use a text image -->
        <!--<h1><a href="#hero">Header 1</a></h1>-->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="index.php">Home</a></li>
          <li><a href="#about">Presentación</a></li>
          <li><a href="#services">Glosario</a></li>
          <li><a href="#team">Autores</a></li>
          <li><a href="#contact">Contacto</a></li>
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
          <h3 class="section-title"> 
              <?php 
                echo $row['nombreConcepto'];
              ?>
            </h3>
          <div class="section-title-divider"></div>
          <p class="section-description">Información del término</p>
        </div>
      </div>

      <tbody>
          <tr>
					      
              <td class="section-subheading text-muted cabeceraTabla margin" width="212" valign="middle" height="50" bgcolor="#ccc"><strong>Palabra</strong></td>
					      
              <td class="large text-muted margin mayuscula" width="976" valign="middle" bgcolor="#ccc"><strong>
                    <?php 
                echo $row['nombreConcepto'];
                    ?>
                  </strong></td>
					    
          </tr>
				    
          <tr>
						
              <td class="section-subheading text-muted margin" valign="middle" height="50" bgcolor="#ccc" align="justify"><strong>Materias</strong></td>
						
              <td class="large text-muted textoAzul margin" valign="middle"><a href="../../ae.html"><?php 
               
                echo $row['nombreConcepto'];
                    ?></a></td>
					
          </tr>
					
          <tr>
						
              <td class="section-subheading text-muted margin" valign="middle" height="50" bgcolor="#ccc" align="justify"><strong>Definición</strong></td>
              <td class="large text-muted margin" valign="middle" height="50" bgcolor="#f7f7f7" align="justify"><?php 
               
                echo $row['definicionConcepto'];
                    ?></td>
          </tr>
					
          <tr>
						
              <td class="section-subheading text-muted margin" valign="middle" height="50" bgcolor="#ccc" align="justify"><strong>Véase</strong></td>
						
              <td class="large text-muted textoMagenta margin" valign="middle" height="50" align="justify">
                       
                  <ul>
                        	
                      <li><a class="textoMagenta" href="../s/SistemaDeComunicacionDeAlarma.html">Sistema de comunicación de alarma</a></li>
                            
                      <li><a class="textoMagenta" href="../s/SistemaManualDeAlarmaDeIncendio.html">Sistema manual de alarma de incendio</a></li>
						
                  </ul>

              </td>
					
          </tr>
					
          <tr>
						
              <td class="section-subheading text-muted margin" valign="middle" height="50" bgcolor="#ccc" align="justify"><strong>Fuente</strong></td>
						
              <td class="large text-muted textoRojo margin" valign="middle" height="50" bgcolor="#f7f7f7" align="justify"><a class="textoRojo" href="../pdf/RealDecreto3932007.pdf" target="_new"><?php 
               
                echo $row['fuenteConcepto'];
                    ?></a></td>
					
          </tr>
					
          <tr>
						
              <td class="section-subheading text-muted margin" valign="middle" height="50" bgcolor="#ccc" align="justify"><strong>Información complementaria</strong></td>
						
              <td class="large text-muted margin" valign="middle" height="50" align="justify"><strong>Alarma de incendios:</strong> aviso o señal por la que se alerta a las personas o instalaciones previstas para actuar ante una situación de emergencia originada por un incendio.</td>
					
          </tr>
					
          <tr>
						
              <td class="section-subheading text-muted margin" valign="middle" height="50" bgcolor="#ccc" align="justify"><strong>Documentación adicional</strong></td>
						
              <td class="large text-muted textoRojo margin" valign="middle" height="50" bgcolor="#f7f7f7" align="justify"><a class="textoRojo" href="../pdf/NTP41.pdf" target="_new">NTP 41: Alarma de incendios</a></td>
					
          </tr>
				
        </tbody>
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
            &copy; Copyright <strong>Universidad de Córdoba</strong>. Realizado por Ismael Ávila Ojeda
          </div>
          <div class="credits">
            <img src="img/logoUco.png" alt="" title="" width="40" height="30"/>
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
