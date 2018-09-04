<?php

require 'General.php';

$idconcepto = 1;
if (isset($_GET['id'])) {
    $idconcepto = $_GET['id'];
}

$row = General::getConcepto($idconcepto);
$rowVease = General::getVease($row['idVeaseConcepto']);

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
          <li class="menu-active"><a href="index.php"><?php echo getTextGeneral(6); ?></a></li>
          <li><a href="index.php#about"><?php echo getTextGeneral(7); ?></a></li>
          <li><a href="index.php#services"><?php echo getTextGeneral(8); ?></a></li>
          <li><a href="index.php#team"><?php echo getTextGeneral(9); ?></a></li>
          <li><a href="index.php#contact"><?php echo getTextGeneral(10); ?></a></li>
           <li><a href="Buscador.php"><?php echo getTextGeneral(11); ?></a></li>
          <li><a href="<?php echo 'Concepto.php?id='.$idconcepto.'&lang=1' ?>"><img src="img/icon_sp.png" alt="" width="30" height="30" title="Spain" /></a></li>
          <li><a href="<?php echo 'Concepto.php?id='.$idconcepto.'&lang=2' ?>"><img src="img/icon_en.png" alt="" width="30" height="30" title="English" /></a></li>
          <li><a href="<?php echo 'Concepto.php?id='.$idconcepto.'&lang=3' ?>"><img src="img/icon_fr.png" alt="" width="30" height="30" title="France" /></a></li>
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
          <h3 class="section-title"> 
              <?php 
                echo General::getConceptoTextLang($row['idNombreConcepto'],$languaje);
              ?>
          </h3>
          <div class="section-title-divider"></div>
          <p class="section-description"><?php echo getTextGeneral(34); ?></p>
        </div>
      </div>
</div>
    <aside>
      <aside>
        <section class="col-md-offset-2 col-md-3 col-lg-offset-1 col-lg-10">
          <aside>
            <main>
              <table min-width="800%" height:"500px" border="1">
                <tbody>
                  <tr>
                    <td class="section-subheading text-muted cabeceraTabla margin" width="212" valign="middle" height="50" bgcolor="#ccc"><strong><?php echo getTextGeneral(35); ?></strong></td>
                    <td class="large text-muted margin mayuscula" width="976" valign="middle" bgcolor="#ccc"><strong>
                      <?php 
                echo General::getConceptoTextLang($row['idNombreConcepto'],$languaje);
                    ?>
                      </strong></td>
                  </tr>
                  <tr>
                    <td class="section-subheading text-muted margin" valign="middle" height="50" bgcolor="#ccc" align="justify"><strong><?php echo getTextGeneral(36); ?></strong></td>
                    <td class="large text-muted textoAzul margin" valign="middle">
                        <?php 
                        echo "<a href='porMateriaExt.php?id=" .$row['idMateria']. "'>" .General::getMateriaTextLang($row['idMateria'],$languaje). "</a>";
                        ?>
                  </td>
                  </tr>
                  <tr>
                  
                    <td class="section-subheading text-muted margin" valign="middle" height="50" bgcolor="#ccc" align="justify"><strong><?php echo getTextGeneral(37); ?></strong></td>
                    <td class="large text-muted margin" valign="middle" height="50" bgcolor="#f7f7f7" align="justify"><?php 
                     
                      echo General::getDefinicionTextLang($row['idDefinicionConcepto'],$languaje);
                          ?></td>
                  </tr>
                  <tr>
                    <td class="section-subheading text-muted margin" valign="middle" height="50" bgcolor="#ccc" align="justify"><strong><?php echo getTextGeneral(38); ?></strong></td>
                    <td class="large text-muted textoMagenta margin" valign="middle" height="50" align="justify">
                      
                      <ul>
                        <?php
                       foreach ($rowVease as $rowVer)
                  {
                           $idConceptoRow = $rowVer['idConcepto'];
                           
                           $concepto = General::getConcepto($idConceptoRow);
                            
                          echo "<li><a class='textoMagenta' href='Concepto.php?id=".$idConceptoRow."'> ".General::getConceptoTextLang($concepto['idNombreConcepto'],$languaje)." </a></li>";
                   
                  }
                      ?>
            
                  </ul>
                      
                    </td>
                  </tr>
                  <tr>
                    <td class="section-subheading text-muted margin" valign="middle" height="50" bgcolor="#ccc" align="justify"><strong><?php echo getTextGeneral(39); ?></strong></td>
                    <td class="large text-muted textoRojo margin" valign="middle" height="50" bgcolor="#f7f7f7" align="justify">
                        <?php 
                        $vease = General::getFuente($row['idfuenteConcepto']);
                         echo "<a class='textoRojo' href='".$vease['linkFuente']."' target='_new'>".$vease['nombreFuente']."</a>";
                    ?>
                        </td>
                  </tr>
                  <tr>
                    <td class="section-subheading text-muted margin" valign="middle" height="50" bgcolor="#ccc" align="justify" ><strong><?php echo getTextGeneral(40); ?></strong></td>
                    <td class="large text-muted margin" valign="middle" height="50" align="justify">
                        <?php 
                            echo General::getInfoCompleTextLang($row['idInfoCompleConcepto'],$languaje);
                        ?>
                      </td>
                  </tr>
                  <tr>
                    <td class="section-subheading text-muted margin" valign="middle" height="50" bgcolor="#ccc" align="justify"><strong><?php echo getTextGeneral(41); ?></strong></td>
                    <td class="large text-muted textoRojo margin" valign="middle" height="50" bgcolor="#f7f7f7" align="justify">
                        <?php 
                            echo  "<a class='textoRojo' href='../pdf/NTP41.pdf' targset='_new'>". General::getDocumAdiciTextLang($row['idDocumentacionAdicionalConcepto'],$languaje). "</a>";
                        ?>
                       </td>
                  </tr>
                  <tr>
                    <td class="section-subheading text-muted margin" valign="middle" height="50" bgcolor="#ccc" align="justify"><strong><?php echo getTextGeneral(42); ?></strong></td>
                    <td class="large text-muted margin" valign="middle" height="50" align="justify">
                         <ul>
                        <?php 
                        $materAudivis = General::getAudioVisual($row['idInfoCompleConcepto']);
                            
                         foreach ($materAudivis as $matAu)
                        {
                             
                             $materialAudi = General::getAudioVisualID($matAu['idMatAudiViConcep']);
                            
                             echo  "<li><a class='textoRojo' href='".$materialAudi['linkMateAudioViConcep']."' targset='_new'>". $materialAudi['nombreMateAudioViCon']. "</a></li>";
                             
                         }
                             ?> </ul></td>
                  </tr>
                </tbody>
              </table>
              <br><br>
            </main>
          </aside>
        </section>
      </aside>
    </aside>
</section>

  <!--==========================
  Footer
============================-->
<main>
    <footer>
      <aside>
        <footer class="col-lg-12" id="footer">
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
</aside>
    </footer>
  </main>
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
